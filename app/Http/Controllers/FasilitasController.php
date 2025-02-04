<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use App\Helper\Killa; // Assuming you have a helper for standardized responses
use Illuminate\Support\Facades\Validator;

class FasilitasController extends Controller
{
    // Fetch all facilities
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $fasilitas);
    }

    // Fetch a single facility by ID
    public function show($id)
    {
        $fasilitas = Fasilitas::find($id);

        if (!$fasilitas) {
            return Killa::responseErrorWithMetaAndResult(404, 0, 'Facility not found', []);
        }

        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $fasilitas);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'icon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
            $object = new Fasilitas();
            $object->name = $request->name;
            $object->description = $request->description;
            $object->created_by = auth()->user()->id; // Set created_by field

            // Handle image upload
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $savePath = "/web_files/fasilitas_image/";
                $path = public_path() . $savePath;
                $file->move($path, $fileName);
                $object->icon = $savePath . $fileName;
            }

            if ($object->save()) {
                return Killa::responseSuccessWithMetaAndResult(
                    201,
                    201,
                    'Facility created successfully',
                    $object
                );
            }

            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'Failed to save facility',
                null
            );
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'An error occurred while saving the facility',
                ['error' => $e->getMessage()]
            );
        }
    }


    // Update an existing facility
    public function update(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:1000',
            'icon' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            // Find the facility
            $fasilitas = Fasilitas::find($id);

            if (!$fasilitas) {
                return Killa::responseErrorWithMetaAndResult(404, 0, 'Facility not found', []);
            }

            // Update the fields that are present in the request
            $fasilitas->name = $request->name ?? $fasilitas->name;
            $fasilitas->description = $request->description ?? $fasilitas->description;
            $fasilitas->created_by = auth()->user()->id; // Set updated_by field

            // Handle the file upload if an icon is provided
            if ($request->hasFile('icon')) {
                // Delete the old icon if it exists
                if ($fasilitas->icon && file_exists(public_path($fasilitas->icon))) {
                    unlink(public_path($fasilitas->icon));
                }

                // Store the new icon
                $file = $request->file('icon');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $savePath = "/web_files/fasilitas_icon/";
                $path = public_path() . $savePath;

                // Ensure directory exists
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $file->move($path, $fileName);
                $fasilitas->icon = $savePath . $fileName;
            }

            // Save the updated facility
            if ($fasilitas->save()) {
                return Killa::responseSuccessWithMetaAndResult(
                    200,
                    200,
                    'Facility updated successfully',
                    $fasilitas
                );
            }

            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'Failed to update facility',
                null
            );
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'An error occurred while updating the facility',
                ['error' => $e->getMessage()]
            );
        }
    }


    // Delete a facility
    // Soft Delete a facility and set deleted_by field
    public function destroy($id)
    {
        try {
            // Find the facility
            $fasilitas = Fasilitas::find($id);

            if (!$fasilitas) {
                return Killa::responseErrorWithMetaAndResult(404, 0, 'Facility not found', []);
            }

            // Update deleted_by field
            $fasilitas->deleted_by = auth()->user()->id;
            $fasilitas->save(); // Save the change

            // Soft delete the facility
            $fasilitas->delete();

            return Killa::responseSuccessWithMetaAndResult(200, 1, 'Facility deleted successfully', []);
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(500, 0, 'Internal Server Error', $e->getMessage());
        }
    }
}
