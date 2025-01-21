<?php

namespace App\Http\Controllers;

use App\Models\MySlider;
use App\Models\OurBrand;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CariQueryController extends Controller
{

    public function cari(Request $request)
    {
        // Check if data is already in cache
        $slug = "mineral-and-coal-laboratory-equipment";
        $cacheKey = 'branxzssxxx_' . $slug;
        $cachedData = Cache::get($cacheKey);



        $ourBrand = OurBrand::where("action_link", '=', $slug)->first();

        $url = "https://wp.bestarilab.com/wp-json/wc/v3/products/categories?page=1&per_page=100&parent=23";
        $apiKey = config('app.api_authorization_key');

        // API credentials
        $consumerKey = 'ck_b80c6c3221800d62fadb72f9e606cc17277f6c8c';
        $consumerSecret = 'cs_21c9a9af9b5723a2a9e61f64c364d6fa30cd9259';


        $headers = [
            'Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ];
        $client = new Client(['headers' => $headers]);
        $filteredData = [];

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), false);


            // Create a new array with new keys for each object
            $filteredData = array_map(function ($item){
                return (object)[
                    'name' => $item->name,
                    'slug' => $item->slug,
                ];
            }, $data);

        } catch (\Exception $e) {
            return $e;
            // Handle the exception, e.g., log it or return an error response.
        }


        return $filteredData;

    }

    public function getCategoryIdBySlug($name)
    {
        $url = "https://wp.bestarilab.com/wp-json/wc/v3/products/categories?search=$name&per_page=100";
        $apiKey = config('app.api_authorization_key');

        // API credentials
        $consumerKey = 'ck_b80c6c3221800d62fadb72f9e606cc17277f6c8c';
        $consumerSecret = 'cs_21c9a9af9b5723a2a9e61f64c364d6fa30cd9259';

        $client = new Client();

        $headers = [
            'Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ];
        $client = new Client(['headers' => $headers]);

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), false);

            // Check if the data array is empty
            if (empty($data)) {
                // Return an empty string when no match is found
                return response()->json(['id' => null, 'name' => ''], 200);
            }

            // Assuming you want to return the ID and name of the first category found
            $firstCategoryId = isset($data[0]->id) ? (int)$data[0]->id : null;
            $firstCategoryName = isset($data[0]->name) ? $data[0]->name : '';

            return response()->json(['id' => $firstCategoryId, 'name' => $firstCategoryName], 200);
        } catch (\Exception $e) {
            // Handle the exception, e.g., log it or return an error response.
            return response()->json(['id' => null, 'name' => ''], 200);
        }
    }

    public function getCategoryOnWeb()
    {
        // Check if data is already in cache
        $cacheKey = 'product_categories';
        $cachedData = Cache::get($cacheKey);

        if ($cachedData) {
            return $cachedData;
        }

        $url = "https://wp.bestarilab.com//wp-json/wc/v3/products/categories?per_page=100&page=1";
        $apiKey = config('app.api_authorization_key');

        // API credentials
        $consumerKey = 'ck_b80c6c3221800d62fadb72f9e606cc17277f6c8c';
        $consumerSecret = 'cs_21c9a9af9b5723a2a9e61f64c364d6fa30cd9259';

        $client = new Client();

        $headers = [
            'Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ];
        $client = new Client(['headers' => $headers]);

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            // Initialize an empty array to store the required fields
            $result = [];

            // Loop through each item in the data and extract id, name, and slug
            foreach ($data as $item) {
                // Skip categories where parent is equal to 0
                if ($item['parent'] !== 0) {
                    $result[] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'slug' => $item['slug']
                    ];
                }
            }

            // Store data in cache for 120 minutes (adjust the time as needed)
            Cache::put($cacheKey, $result, 120);

            return $result;
        } catch (Exception $e) {
            // Handle exception
            return [];
        }
    }
}
