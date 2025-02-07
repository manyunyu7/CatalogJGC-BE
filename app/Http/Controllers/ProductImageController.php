<?php

namespace App\Http\Controllers;

use App\Helper\Killa;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function getAll(Request $request)
    {
        $query = ProductImage::query();

        // Optional: Filter by parent_id if provided
        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        }

        $images = $query->orderBy('created_at', 'desc')->get();

        return Killa::responseSuccessWithMetaAndResult(
            200,
            200,
            'Images retrieved successfully.',
            $images
        );
    }

    // Store multiple images
    public function store(Request $request, $parentId)
    {
        // Validate the images
        $validated = $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Extract type and description from the request
        $type = $validated['type'] ?? null;
        $description = $validated['description'] ?? null;

        // Process each image
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Generate file name and define save path
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '-' . uniqid() . '.' . $extension;
                $savePath = "/web_files/products/";
                $path = public_path() . $savePath;

                // Ensure directory exists
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Move the file
                $file->move($path, $fileName);

                // Save image record in the database
                $imageRecord = ProductImage::create([
                    'parent_id' => $parentId,
                    'type' => $type,
                    'description' => $description, // Fixed the typo
                    'image_path' => $savePath . $fileName,
                ]);

                // Store in imagePaths array
                $imagePaths[] = $imageRecord;
            }
        }

        return Killa::responseSuccessWithMetaAndResult(
            201,
            201,
            'Images uploaded successfully.',
            $imagePaths
        );
    }


    // Delete image
    public function destroy($id)
    {
        // Find the image by ID
        $image = ProductImage::find($id);

        if (!$image) {
            return Killa::responseErrorWithMetaAndResult(
                404,
                404,
                'Image not found.',
                null
            );
        }

        // // Delete the image file from storage
        // Storage::delete($image->image_path);

        // Soft delete the record from the database
        $image->delete();

        return Killa::responseSuccessWithMetaAndResult(
            200,
            200,
            'Image deleted successfully.',
            null
        );
    }

    // Reorder images
    public function reorderImages(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:product_images,id',
            'images.*.position' => 'required|integer',
        ]);

        foreach ($request->images as $image) {
            ProductImage::where('id', $image['id'])->update(['position' => $image['position']]);
        }

        return Killa::responseSuccessWithMetaAndResult(
            200,
            200,
            'Image order updated successfully.',
            null
        );
    }
}
