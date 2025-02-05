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
   
    //fetch all products
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

    foreach ($productDetails->types ?? [] as $type) {
        foreach ($type->categories ?? [] as $category) {
            // Add the full image path to each plan
            foreach ($category->plans ?? [] as &$plan) {
                // Create the full image URL for each plan
                $plan->full_image_path = "https://jakartagardencity.com/_next/image?url=https%3A%2F%2Fapi-web.jakartagardencity.com%2F" . urlencode($plan->image) . "&w=1920&q=75";
            }

            foreach ($productDetails->images as $images) {
                $images->full_image_path = "https://jakartagardencity.com/_next/image?url=https%3A%2F%2Fapi-web.jakartagardencity.com%2F" . urlencode($images->image) . "&w=1920&q=75";
            }

            $price = "";
            $priceFormatted = "";
            $pricePrefix = "";
            // Data Price
            $dataPrice = ProductPrice::where("parent_id", '=', $category->id)->first();
            if ($dataPrice != null) {
                $price = $dataPrice->price;
                $pricePrefix = $dataPrice->prefix;
                $priceFormatted = "Rp " . number_format($dataPrice->price, 0, ',', '.'); // Format price with Rp
            } else {
                $price = null;
                $pricePrefix = "";
                $priceFormatted = ""; // Format price with Rp
            }

            $promo = $productDetails->promos ?? [];
            $is_promo = !empty($promo);

            $categoriesSet[] = (object)[
                'id' => $category->id,
                'category_name' => $category->name_id,
                'parent_id' => $productDetails->id ?? '',
                'parent_name' => $productDetails->name ?? '',
                'property_type' => $propertyType, 
                'promo' => $productDetails->promos ?? '',
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
    }

    return $categoriesSet;
    }
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
