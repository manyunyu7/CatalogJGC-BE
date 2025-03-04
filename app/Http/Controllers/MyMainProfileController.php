<?php

namespace App\Http\Controllers;

use App\Helper\Killa;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MyMainProfileController extends Controller
{
    // Fetch all products
    // Fetch all products
    public function index(Request $request)
    {
        // Cache the fetched categories for 1 minute
        $cacheKey = 'z12_categories_cache';
        $products = Cache::remember($cacheKey, 600, function () {
            return $this->fetchCategories();
        });

        foreach ($products as $product) {
            // Fetch images related to the product
            // Fetch images related to the product
            $query = ProductImage::query();
            $query->where('parent_id', $product->id);

            $images = $query->orderBy('created_at', 'desc')->get();


            // Ensure $product->images exists and is an array
            if (!isset($product->images) || !is_array($product->images)) {
                $product->images = [];
            }

            // Prepend fetched images from the model to existing ones
            $product->images = array_merge($images->toArray(), $product->images);

            // Optionally add a new static image at the beginning
            // array_unshift($product->images, [
            //     'url' => 'https://example.com/new-image.jpg',
            //     'alt' => 'New Image Description'
            // ]);
        }

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

        // Ambil semua ProductDetail di awal
        $productDetails = ProductDetail::all()->keyBy('parent_id');

        while ($hasNextPage) {
            $response = Http::get("https://api-web.jakartagardencity.com/product?page={$page}&pageSize=20");
            $data = $response->object(); // Use object() instead of json()

            $hasNextPage = $data->data->has_next_page ?? false;
            $products = $data->data->data;

            foreach ($products as $product) {
                $productDetailsData = $this->fetchProductDetails($product->id);
                $allCategories = array_merge($allCategories, $this->extractCategories($productDetailsData, $productDetails));
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
    private function extractCategories($productDetails, $productDetailsCollection)
    {
        $categoriesSet = [];
        $propertyType = isset($productDetails->type) ? $this->getPropertyType($productDetails->type) : 'Unknown';

        if (!empty($productDetails->types)) {
            foreach ($productDetails->types as $type) {
                if (!empty($type->categories)) {
                    foreach ($type->categories as $category) {
                        $categoriesSet[] = $this->buildCategoryData($productDetails, $category, $propertyType, $productDetailsCollection);
                    }
                } else {
                    $categoriesSet[] = $this->buildCategoryData($productDetails, $type, $propertyType, $productDetailsCollection);
                }
            }
        } else {
            $categoriesSet[] = $this->buildCategoryData($productDetails, $productDetails, $propertyType, $productDetailsCollection);
        }

        return $categoriesSet;
    }

    // Helper function to build category data
    private function buildCategoryData($productDetails, $category, $propertyType, $productDetailsCollection)
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

        // Generate slugs
        $categoryName = $category->name_id ?? $productDetails->name ?? '';
        $parentName = $productDetails->name ?? '';

        $titleSlug = Str::slug($categoryName);
        $clusterSlug = Str::slug($parentName);
        $fullSlug = trim($clusterSlug . '/' . $titleSlug, '/');

        // Cek apakah kategori memiliki data `ProductDetail`
        $detail = $productDetailsCollection->get($category->id);
        $floor = $detail ? $detail->floor : 0;
        $land_length = $detail ? $detail->land_length : 0;
        $land_width = $detail ? $detail->land_width : 0;
        $building_length = $detail ? $detail->building_length : 0;
        $building_width = $detail ? $detail->building_width : 0;


        return (object)[
            'ciloqciliq' => "priskilla oktaviani",
            'yepow' => "yessy permatasari",
            'mekar' => $detail ?? '',
            'id' => $category->id ?? '',
            'floor' => $floor ?? 0,
            'land_length' => $land_length ?? 0,
            'land_width' => $land_width ?? 0,
            'building_length' => $building_length ?? 0,
            'building_width' => $building_width ?? 0,
            'category_name' => $categoryName,
            'title_slug' => $titleSlug,
            'parent_id' => $productDetails->id ?? '',
            'parent_name' => $parentName,
            'cluster_slug' => $clusterSlug,
            'full_slug' => $fullSlug,
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
            'additional_room' => $category->additional_room ?? 0,
            'additional_room_bonus' => $category->additional_room_bonus ?? 0,
            'bedroom' => $category->bedroom ?? 0,
            'bedroom_bonus' => $category->bedroom_bonus ?? 0,
            'bathroom' => $category->bathroom ?? 0,
            'bathroom_bonus' => $category->bathroom_bonus ?? 0,
            'garage' => $category->garage ?? 0,
            'garage_bonus' => $category->garage_bonus ?? 0,
            'room' => $category->room ?? 0,
            'room_bonus' => $category->room_bonus ?? 0,
            'kitchen' => $category->kitchen ?? 0,
            'kitchen_bonus' => $category->kitchen_bonus ?? 0,
            'living_room' => $category->living_room ?? 0,
            'living_room_bonus' => $category->living_room_bonus ?? 0,
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
