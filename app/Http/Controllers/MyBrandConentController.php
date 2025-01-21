<?php

namespace App\Http\Controllers;

use App\Models\MySlider;
use App\Models\OurBrand;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MyBrandConentController extends Controller
{

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

//        if ($cachedData) {
//            return $cachedData;
//        }

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

    public function getProductByBrand(Request $request, $slug)
    {
        // Check if data is already in cache
        $cacheKey = 'branxzssxxx_' . $slug;
        $cachedData = Cache::get($cacheKey);
        $categoryOnWeb = $this->getCategoryOnWeb();

        if ($cachedData) {

            if($request->dump==true){
                return $cachedData;
            }
//            return view("profile.eterna.brand.brand_detail")->with($cachedData);
        }
        $sliders = MySlider::orderBy('order')->get();

        $brandIdResponse = json_decode($this->getCategoryIdBySlug($slug)->getContent());
        $brandName = $brandIdResponse->name;
        $brandId = $brandIdResponse->id;

        $ourBrand = OurBrand::where("action_link", '=', $slug)->first();

        $url = "https://wp.bestarilab.com/wp-json/wc/v3/products?per_page=100&page=1&category=$brandId";
        $apiKey = config('app.api_authorization_key');

        // API credentials
        $consumerKey = 'ck_b80c6c3221800d62fadb72f9e606cc17277f6c8c';
        $consumerSecret = 'cs_21c9a9af9b5723a2a9e61f64c364d6fa30cd9259';

        $client = new Client();

        $headers = [
            'Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ];
        $client = new Client(['headers' => $headers]);
        $filteredData = [];

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), false);

            // Create a new array with new keys for each object
            $filteredData = array_map(function ($item) use ($brandName, $brandId) {
                $image = "";

                if ($item->images != null) {
                    $image = $item->images[0];
                }
                return (object)[
                    'name' => $item->name,
                    'brand-name' => $brandName,
                    'brand-id' => $brandId,
                    'slug' => $item->slug,
                    'permalink' => $item->permalink,
                    'images' => $image->src ?? "https://bestarilab.com/wp-content/uploads/woocommerce-placeholder-600x600.png",
                    'created_at' => $item->date_created,
                    'categories' => $item->categories,
                    'others'=>$item
                    // Add more new keys as needed
                ];
            }, $data);

        } catch (\Exception $e) {
            return $e;
            // Handle the exception, e.g., log it or return an error response.
        }

        $brand_id = $brandId;
        $brand_name = $brandName;
        $ourBrand = $ourBrand;
        $cover_image = "";
        $title = "";
        $description = "";
        $brand_slug = $slug;
        $full_slug = $slug;
        $products = $filteredData;
        $isBrandNull = false;


        if($ourBrand==null){
            $ourBrand = new \stdClass();
            $ourBrand->full_image_path="";
            $ourBrand->full_poster_path="";
            $ourBrand->title="$brandName";
            $ourBrand->description="";
            $isBrandNull = true;
        }
        $ourBrands = OurBrand::all();

        // Compact the variables
        $compact = compact(
            'ourBrand',
            'brand_id',
            'brand_name',
            'cover_image',
            'title',
            'sliders',
            'categoryOnWeb',
            'ourBrands',
            'description',
            'brand_slug',
            'full_slug',
            'products',
            'isBrandNull'
        );

        // Store data in cache for 120 minutes (adjust the time as needed)
        Cache::put($cacheKey, $compact, 160);

        if ($request->dump == true) {
            return $compact;
        }

        return view("profile.eterna.brand.brand_detail")->with($compact);
    }

    public function getProductAll(Request $request)
    {
        // Check if data is already in cache
        $cacheKey = 'all_products';
        $cachedData = Cache::get($cacheKey);
        $ourBrands = OurBrand::all();

        $categoryOnWeb = $this->getCategoryOnWeb();

        if ($cachedData) {
            if ($request->dump == true) {
                return $cachedData;
            }
            return view("profile.eterna.brand.brand_detail")->with($cachedData);
        }

        $brandName = "Semua";
        $brandId = "2";

        $ourBrand = OurBrand::where("action_link", '=', "")->first();

        // API credentials
        $consumerKey = 'ck_b80c6c3221800d62fadb72f9e606cc17277f6c8c';
        $consumerSecret = 'cs_21c9a9af9b5723a2a9e61f64c364d6fa30cd9259';

        $client = new Client();

        $headers = [
            'Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ];
        $client = new Client(['headers' => $headers]);

        $page = 1;
        $products = [];

        try {
            do {
                $url = "https://wp.bestarilab.com/wp-json/wc/v3/products?per_page=100&page=" . $page;
                $response = $client->request('GET', $url);
                $data = json_decode($response->getBody(), false);

                // If there are products on this page, add them to the products array
                if (!empty($data)) {
                    $filteredData = array_map(function ($item) use ($brandName, $brandId) {
                        $image = "";
                        if ($item->images != null) {
                            $image = $item->images[0];
                        }
                        return (object)[
                            'name' => $item->name,
                            'brand-name' => $brandName,
                            'brand-id' => $brandId,
                            'slug' => $item->slug,
                            'permalink' => $item->permalink,
                            'images' => $image->src ?? "https://bestarilab.com/wp-content/uploads/woocommerce-placeholder-600x600.png",
                            'created_at' => $item->date_created,
                            'categories' => $item->categories,
                            // Add more new keys as needed
                        ];
                    }, $data);
                    $products = array_merge($products, $filteredData);
                    $page++;
                } else {
                    break; // No more products on subsequent pages
                }
            } while (true);
        } catch (\Exception $e) {
            return $e;
            // Handle the exception, e.g., log it or return an error response.
        }

        $brand_id = $brandId;
        $brand_name = $brandName;
        $cover_image = "";
        $title = "";
        $description = "";
        $brand_slug = "";
        $full_slug = "";
        $isBrandNull = false;

        if ($ourBrand == null) {
            $ourBrand = new \stdClass();
            $ourBrand->full_image_path = "";
            $ourBrand->full_poster_path = "";
            $ourBrand->title = "$brandName";
            $ourBrand->description = "";
            $isBrandNull = true;
        }
        $sliders = MySlider::orderBy('order')->get();

        // Compact the variables
        $compact = compact(
            'ourBrand',
            'brand_id',
            'brand_name',
            'cover_image',
            'title',
            'description',
            'brand_slug',
            'full_slug',
            'ourBrands',
            'categoryOnWeb',
            'sliders',
            'products',
            'isBrandNull'
        );

        // Store data in cache for 120 minutes (adjust the time as needed)
        Cache::put($cacheKey, $compact, 160);

        if ($request->dump == true) {
            return $compact;
        }

        return view("profile.eterna.brand.brand_detail")->with($compact);
    }

}
