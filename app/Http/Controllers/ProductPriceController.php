<?php

namespace App\Http\Controllers;

use App\Helper\Killa;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductPriceController extends Controller
{
    public function updatePrice(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required|string|max:255', // Parent ID is required for identifying the record
            'prefix' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return Killa::responseErrorWithMetaAndResult(
                400,
                1001,
                'Validation Error',
                $validator->errors()
            );
        }

        try {
            // Find the record by parent_id or create a new one
            $productPrice = ProductPrice::firstOrNew(['parent_id' => $request->parent_id]);

            // Assign values
            $productPrice->prefix = $request->prefix;
            $productPrice->price = $request->price;
            $productPrice->parent_id = $request->parent_id;
            $productPrice->save();

            // Respond with success
            $message = $productPrice->wasRecentlyCreated
                ? 'Product price created successfully'
                : 'Product price updated successfully';

            return Killa::responseSuccessWithMetaAndResult(
                200,
                1000,
                $message,
                $productPrice
            );
        } catch (\Exception $e) {
            // Handle any unexpected errors
            return Killa::responseErrorWithMetaAndResult(
                500,
                1002,
                'An error occurred while processing your request',
                ['error' => $e->getMessage()]
            );
        }
    }
}
