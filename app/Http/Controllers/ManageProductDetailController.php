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
            'electricity' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return Killa::responseErrorWithMetaAndResult(
                422,
                422,
                'Validation errors occurred',
                $validator->errors()
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
            $productDetail->fill($request->only(['floor', 'electricity', 'description']));

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
