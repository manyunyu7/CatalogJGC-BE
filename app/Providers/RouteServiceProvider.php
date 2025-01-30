<?php

namespace App\Providers;

use App\Models\ContactWhatsapp;
use App\Models\MyBasicIdentity;
use App\Models\OurBrand;
use GuzzleHttp\Client;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        // $profile = MyBasicIdentity::all()->last();
        // $whatsapp = ContactWhatsapp::all();

        // $commonEnvironmental = $this->cari("21");
        // $commonGeneral = $this->cari("23");
        // $commonMineral = $this->cari("22");
        // $commonWaterPurification = $this->cari("26");

        $this->configureRateLimiting();

        // $profile = MyBasicIdentity::all()->last() ?? new MyBasicIdentity();
        // $whatsapp = ContactWhatsapp::all() ?? collect();

        // $commonEnvironmental = $this->cari("21") ?? 'Default Environmental Value';
        // $commonGeneral = $this->cari("23") ?? 'Default General Value';
        // $commonMineral = $this->cari("22") ?? 'Default Mineral Value';
        // $commonWaterPurification = $this->cari("26") ?? 'Default Water Purification Value';

        // View::share('profileData', $profile);
        // View::share('commonWhatsapp', $whatsapp);

        // View::share('commonMineral', $commonMineral);
        // View::share('commonWaterPurification', $commonWaterPurification);
        // View::share('commonGeneral', $commonGeneral);
        // View::share('commonEnvironmental', $commonEnvironmental);


        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }



    public function cari($categoryId)
    {
        // Define cache key
        $cacheKey = 'categoryxx_' . $categoryId;

        // Check if data is already cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // API credentials
        $consumerKey = 'ck_b80c6c3221800d62fadb72f9e606cc17277f6c8c';
        $consumerSecret = 'cs_21c9a9af9b5723a2a9e61f64c364d6fa30cd9259';

        $url = "https://wp.bestarilab.com/wp-json/wc/v3/products/categories?page=1&per_page=100&parent={$categoryId}";

        $headers = [
            'Authorization' => 'Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ];
        $client = new Client(['headers' => $headers]);
        $filteredData = [];

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody());

            // Create a new array with new keys for each object
            $filteredData = array_map(function ($item){
                return (object)[
                    'name' => $item->name,
                    'slug' => $item->slug,
                ];
            }, $data);

            // Cache the data
            Cache::put($cacheKey, $filteredData, 3600); // Cache for 1 hour
        } catch (\Exception $e) {
            // In case of any errors, return empty array
            return [];
        }

        return $filteredData;
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(120)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
