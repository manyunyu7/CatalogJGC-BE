<?php

namespace App\Http\Controllers;

use App\Helper\Killa;
use App\Models\ProductPrice;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MyMainProfileController extends Controller
{
    // Fetch all products
    public function index(Request $request)
    {
        // Cache the fetched categories for 10 minutes (600 seconds)
        $cacheKey = 'z3_categories_cache';
        $products = Cache::remember($cacheKey, 600, function () {
            return $this->fetchCategories();
        });

        // Prepare compacted data
        $compact = compact('products');

        // Return data if dump is requested
        if ($request->dump == true) {
            return $compact;
        }

        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $products);
    }

    // Fetch and process categories from the API
    private function fetchCategories()
    {
        $allCategories = [];
        $page = 1;
        $hasNextPage = true;

        while ($hasNextPage) {
            $response = Http::get("https://api-web.jakartagardencity.com/product?page={$page}&pageSize=20");
            $data = $response->object(); // Use object() instead of json()

            $hasNextPage = $data->data->has_next_page ?? false;
            $products = $data->data->data;

            foreach ($products as $product) {
                $productDetails = $this->fetchProductDetails($product->id);
                $allCategories = array_merge($allCategories, $this->extractCategories($productDetails));
            }
            $page++;
        }

        return $allCategories;
    }

    // Fetch detailed product info
    private function fetchProductDetails($productId)
    {
        try {
            $response = Http::get("https://api-web.jakartagardencity.com/product/{$productId}");
            return $response->object()->data ?? null; // Access with -> data
        } catch (\Exception $e) {
            return null;
        }
    }

    // Extract unique categories from product details
    private function extractCategories($productDetails)
    {
        $categoriesSet = [];
        $propertyType = isset($productDetails->type) ? $this->getPropertyType($productDetails->type) : 'Unknown'; // Pastikan type ada

        // Jika produk memiliki tipe (types)
        if (!empty($productDetails->types)) {
            foreach ($productDetails->types as $type) {
                // Jika tipe memiliki sub-tipe (categories)
                if (!empty($type->categories)) {
                    foreach ($type->categories as $category) {
                        $categoriesSet[] = $this->buildCategoryData($productDetails, $category, $propertyType);
                    }
                } else {
                    // Jika tipe tidak memiliki sub-tipe, gunakan data dari tipe utama
                    $categoriesSet[] = $this->buildCategoryData($productDetails, $type, $propertyType);
                }
            }
        } else {
            // Jika produk tidak memiliki tipe sama sekali, gunakan data produk utama
            $categoriesSet[] = $this->buildCategoryData($productDetails, $productDetails, $propertyType);
        }

        return $categoriesSet;
    }

    // Helper function to build category data
    private function buildCategoryData($productDetails, $category, $propertyType)
    {
        // Add the full image path to each plan
        foreach ($category->plans ?? [] as &$plan) {
            $plan->full_image_path = $this->getFullImagePath($plan->image ?? '');
        }

        // Add the full image path to product images
        foreach ($productDetails->images ?? [] as &$image) {
            $image->full_image_path = $this->getFullImagePath($image->image ?? '');
        }

        // Data Price
        $dataPrice = ProductPrice::where("parent_id", '=', $category->id)->first();
        $price = $dataPrice->price ?? null;
        $pricePrefix = $dataPrice->prefix ?? '';
        $priceFormatted = $price ? "Rp " . number_format($price, 0, ',', '.') : '';

        // Check if product has promo
        $promo = $productDetails->promos ?? [];
        $is_promo = !empty($promo);

        return (object)[
            'id' => $category->id ?? '',
            'category_name' => $category->name_id ?? $productDetails->name ?? '',
            'parent_id' => $productDetails->id ?? '',
            'parent_name' => $productDetails->name ?? '',
            'property_type' => $propertyType,
            'promo' => $promo,
            'is_promo' => $is_promo,
            'price' => $price,
            'price_formatted' => $priceFormatted,
            'price_prefix' => $pricePrefix,
            'images' => $productDetails->images ?? [],
            'plans' => $category->plans ?? [],
            'luas_tanah' => $category->luas_tanah ?? null,
            'luas_bangunan' => $category->luas_bangunan ?? null,
        ];
    }

    // Helper function to get full image path
    private function getFullImagePath($image)
    {
        if (empty($image)) {
            return '';
        }
        return "https://jakartagardencity.com/_next/image?url=https%3A%2F%2Fapi-web.jakartagardencity.com%2F" . urlencode($image) . "&w=1920&q=75";
    }

    // Get property type
    private function getPropertyType($type)
    {
        $types = [
            0 => 'Perumahan',
            1 => 'Apartemen',
            2 => 'Komersil'
        ];

        return $types[$type] ?? 'Unknown';
    }
}
