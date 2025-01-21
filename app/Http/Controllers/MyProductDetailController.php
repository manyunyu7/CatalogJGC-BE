<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MyProductDetailController extends Controller
{
    public function getPreview()
    {
        return view('our_product.detail_product');
    }

    public function getProduct(Request $request, $slug, $useCache = true)
    {
        // Check if the data is already in the cache
        $cacheKey = "prwodussct_s$slug";
        $cachedData = $useCache ? Cache::get($cacheKey) : null;

//        if ($cachedData) {
//            // If data is found in the cache, return it
//
//            if($request->dump==true){
//                return $cachedData;
//            }
//            return view('our_product.detail_product')->with($cachedData);
//        }

        $slugUrl = "https://wp.bestarilab.com/wp-json/wc/v3/products?slug=$slug";
        $apiKey = config('app.api_authorization_key');

        // API credentials
        $consumerKey = 'ck_b80c6c3221800d62fadb72f9e606cc17277f6c8c';
        $consumerSecret = 'cs_21c9a9af9b5723a2a9e61f64c364d6fa30cd9259';

        $client = new Client();

        $headers = [
            'Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ];
        $client = new Client(['headers' => $headers]);

        // First request to get product ID by slug
        $responseSlug = $client->request('GET', $slugUrl);
        $dataSlug = json_decode($responseSlug->getBody(), false);

        // Check if the $dataSlug array is not empty
        if (!empty($dataSlug)) {
            $productId = $dataSlug[0]->id;

            // Construct the URL for the second request using the obtained product ID
            $url = "https://wp.bestarilab.com/wp-json/wc/v3/products/$productId";

            // Second request to get detailed product information
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), false);

            // Check if the $data array is not empty
            if (!empty($data)) {
                $product = $data;

                $images = $product->images;
                $main_image_url = "";
                $desc = "";
                $shortDesc = "";
                $relatedProducts = [];


                // Assuming $product->meta_data is your array
                foreach ($product->meta_data as $meta) {
                    // Check if the current $meta has the key "_et_pb_old_content"
                    if ($meta->key === '_et_pb_old_content') {
                        // Retrieve and store the value in a variable
                        $et_pb_old_content = $meta->value;

                        // Do something with $et_pb_old_content
                        $desc = $et_pb_old_content;
                        $desc = $this->addBootstrapClassesToTables($desc);
                        // If you only need the first occurrence, you can break out of the loop
                        break;
                    }
                }

                $images = $data->images;
                if (!empty($images)) {
                    $main_image_url = $images[0]->src;
                }

                if($desc==""){
                    $desc=$product->description;
                }

                $shortDesc = $product->short_description;

                // Assuming $product->meta_data is your array
//                foreach ($product->related_ids as $item) {
//                    // Check if the current $meta has the key "_et_pb_old_content"
//                    // Construct the URL for the second request using the obtained product ID
//                    $url = "https://wp.bestarilab.com/wp-json/wc/v3/products/$item";
//
//                    // Second request to get detailed product information
//                    $response = $client->request('GET', $url);
//                    $data = json_decode($response->getBody(), false);
//
//                    $images = $data->images;
//                    $relatedImageUrl = "";
//                    $category = "";
//
//                    if (!empty($images)) {
//                        $relatedImageUrl = $images[0]->src;
//                    }
//
//                    $categories = $data->categories;
//                    if (!empty($categories)) {
//                        $category = $categories[0]->name;
//                    }
//
//                    // Create an object with specific properties
//                    $productObject = new \stdClass();
//                    $productObject->name = $data->name; // Replace 'name' with the actual property name in $data
//                    $productObject->image = $main_image_url; // Replace 'image' with the actual property name in $data
//                    $productObject->slug = $data->slug; // Replace 'image' with the actual property name in $data
//
//                    // Push the object into the $relatedProductCleansed array
//                    array_push($relatedProducts, $productObject);
//                }


                if (!empty($images)) {
                    $main_image_url = $images[0]->src;
                }
                $compact = compact('desc', 'relatedProducts', 'product', 'main_image_url','shortDesc');

                // Cache the data for future use if $useCache is true
//                if ($useCache) {
//                    Cache::put($cacheKey, $compact, now()->addMinutes(60)); // You can adjust the cache expiration time
//                }

                if ($request->dump == true) {
                    return $compact;
                }

                return view('our_product.detail_product')->with($compact);
            } else {
                // Handle the case where no data is returned in the second request
                return null;
            }
        } else {
            // Handle the case where no data is returned in the first request
            return null;
        }
    }


    private function addBootstrapClassesToTables($html)
    {
        // Add Bootstrap classes to tables
        $html = preg_replace_callback('/<table[^>]*>/', function ($matches) {
            $table = $matches[0];
            // Check if the table already has a class attribute
            if (strpos($table, 'class=') !== false) {
                // Add Bootstrap classes to the existing class attribute
                return preg_replace('/class=["\'](.*?)["\']/', 'class="$1 table table-bordered table-striped"', $table);
            } else {
                // Add Bootstrap classes to a new class attribute
                return str_replace('<table', '<table class="table table-bordered table-striped"', $table);
            }
        }, $html);

        return $html;
    }
}
