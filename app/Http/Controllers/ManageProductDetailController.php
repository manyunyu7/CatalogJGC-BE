<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Helper\Killa;
use Illuminate\Support\Facades\Validator;

class ManageProductDetailController extends Controller
{
    // Get product details by parent_id
    public function index($parent_id)
    {
        $productDetails = ProductDetail::where('parent_id', $parent_id)->get();

        if ($productDetails->isEmpty()) {
            return Killa::responseErrorWithMetaAndResult(404, 0, 'No product details found for this parent', []);
        }

        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $productDetails);
    }

    // Store or Update product detail based on parent_id
    public function storeOrUpdate(Request $request, $parent_id)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'floor' => 'nullable|string|max:255',
            // 'map_embed_code' => ['nullable', 'regex:/^<iframe.*src="https?:\/\/[a-zA-Z0-9.-]+[a-zA-Z]{2,}.*"[^>]*><\/iframe>$/'],
            'electricity' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return Killa::responseErrorWithMetaAndResult(
                422,
                422,
                'Validation errors occurred',
                ['validation_errors' => $validator->errors()] // Add custom key 'validation_errors' before errors
            );
        }

        try {
            // Check if a record already exists for this parent_id
            $productDetail = ProductDetail::where('parent_id', $parent_id)->first();

            if (!$productDetail) {
                $productDetail = new ProductDetail();
                $productDetail->parent_id = $parent_id;
            }

            // Update fields
            $productDetail->fill($request->only(['floor', 'electricity', 'description', 'map_embed_code']));

            // Manipulate the map_embed_code to add the proper styles
            if ($request->has('map_embed_code')) {
                $mapEmbedCode = $request->input('map_embed_code');

                // Add the classes 'w-full h-full rounded-xl' to the iframe
                // Ensure this is a valid iframe
                if (preg_match('/<iframe[^>]+>/', $mapEmbedCode)) {
                    $mapEmbedCode = preg_replace('/<iframe(.*)>/', '<iframe class="w-full h-full rounded-xl" $1></iframe>', $mapEmbedCode);
                }

                // Set the manipulated code
                $productDetail->map_embed_code = $mapEmbedCode;
            }

            // Save the record
            if ($productDetail->save()) {
                return Killa::responseSuccessWithMetaAndResult(
                    $productDetail->wasRecentlyCreated ? 201 : 200,
                    $productDetail->wasRecentlyCreated ? 201 : 200,
                    $productDetail->wasRecentlyCreated ? 'Product Detail created successfully' : 'Product Detail updated successfully',
                    $productDetail
                );
            }

            return Killa::responseErrorWithMetaAndResult(500, 500, 'Failed to save product detail', null);
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(500, 500, 'An error occurred', ['error' => $e->getMessage()]);
        }
    }


    // Delete a product detail by parent_id
    public function destroy($parent_id)
    {
        try {
            $productDetail = ProductDetail::where('parent_id', $parent_id)->first();

            if (!$productDetail) {
                return Killa::responseErrorWithMetaAndResult(404, 0, 'Product Detail not found', []);
            }

            // Soft delete the product detail
            $productDetail->delete();

            return Killa::responseSuccessWithMetaAndResult(200, 1, 'Product Detail deleted successfully', []);
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(500, 0, 'Internal Server Error', ['error' => $e->getMessage()]);
        }
    }
}
