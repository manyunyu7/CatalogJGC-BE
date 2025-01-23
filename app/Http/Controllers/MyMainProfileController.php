<?php
namespace App\Http\Controllers;

use App\Helper\Killa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MyMainProfileController extends Controller
{
    public function index(Request $request)
    {
        // Cache key for the products
        $cacheKey = 'products_csacxshex12';

        // Check and fetch products from cache or database
        $products = Cache::remember($cacheKey, 1440, function () {
            return $this->fetchCategories();
        });

        // Prepare compacted data
        $compact = compact('products');

        // Return data if dump is requested
        if ($request->dump == true) {
            return $compact;
        }


        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $products);
        // Return view with products
        return view('catalog.index')->with($compact);
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

                $categoriesSet[] = (object)[
                    'id' => $category->id,
                    'category_name' => $category->name_id,
                    'parent_name' => $productDetails->name ?? '',
                    'images' => $productDetails->images ?? [],
                    'plans' => $category->plans ?? [],
                ];
            }
        }



        return $categoriesSet;
    }
}
