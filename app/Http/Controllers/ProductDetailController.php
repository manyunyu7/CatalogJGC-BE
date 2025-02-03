<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Killa;
use App\Models\Fasilitas;
use App\Models\FasilitasTransaction;
use App\Models\ProductPrice;
use GuzzleHttp\Client;
use stdClass;

class ProductDetailController extends Controller
{
    public function show(Request $request, $parentId, $id)
    {
        $clusterId = $parentId;
        $parentId = $parentId;
        $apiUrl = "https://api-web.jakartagardencity.com/product/$clusterId";

        try {
            // Initialize Guzzle Client
            $client = new Client();

            // Make GET Request
            $response = $client->get($apiUrl);

            // return $response;
            $statusCode = $response->getStatusCode();


            // Parse Response
            if ($statusCode === 200) {
                $responseBody = json_decode($response->getBody(), true);

                if (isset($responseBody['data'])) {
                    // Convert array to a nested object
                    $product = json_decode(json_encode($responseBody['data']));

                    // Data Price
                    $dataPrice = ProductPrice::where("parent_id", '=', $id)->first();
                    if ($dataPrice != null) {
                        $product->price = (object) $dataPrice;
                    } else {
                        $product->price = null;
                    }

                    //get all facility
                    $facilities = Fasilitas::all(); // Convert collection to array
                    $facilitiesTransaction = FasilitasTransaction::where("parent_id", '=', $id)->get();

                    //class to hold responses
                    $dataResponse = new stdClass();
                    $dataResponse->product = $product;
                    $dataResponse->facilities = $facilities;
                    $dataResponse->facilities_transaction = $facilitiesTransaction;

                    // Return success response
                    return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $dataResponse);
                } else {
                    return Killa::responseErrorWithMetaAndResult(200, 0, 'Invalid response format', $responseBody);
                }
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle 4xx Errors
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody(), true);
            return Killa::responseErrorWithMetaAndResult($response->getStatusCode(), 0, 'Client Error', $errorBody);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Handle 5xx Errors
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody(), true);
            return Killa::responseErrorWithMetaAndResult($response->getStatusCode(), 0, 'Server Error', $errorBody);
        } catch (\Exception $e) {
            // Handle Other Errors
            return Killa::responseErrorWithMetaAndResult(500, 0, 'An unexpected error occurred', $e->getMessage());
        }
    }
}
