<?php

namespace App\Http\Controllers;

use App\Helper\Killa;
use App\Models\MySlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyProfileSliderController extends Controller
{
    public function manageSlider()
    {
        try {
            $datas = MySlider::orderBy('order')->get();

            return Killa::responseSuccessWithMetaAndResult(
                200,
                200,
                'Sliders fetched successfully',
                $datas
            );
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'Failed to fetch sliders',
                ['error' => $e->getMessage()]
            );
        }
    }

    public function viewEdit($id)
    {
        try {
            $data = MySlider::where('id', '=', $id)->first();

            if ($data) {
                return Killa::responseSuccessWithMetaAndResult(
                    200,
                    200,
                    'Slider data fetched successfully',
                    $data
                );
            }

            return Killa::responseErrorWithMetaAndResult(
                404,
                404,
                'Slider not found',
                null
            );
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'Failed to fetch slider data',
                ['error' => $e->getMessage()]
            );
        }
    }

    public function update(Request $request)
    {
        $object = MySlider::findOrFail($request->id);
        $object->title = $request->title;
        $object->description = $request->description;
        $object->order = $request->order;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // remove existing photo first
            $file_path = public_path() . $object->image;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (\Exception $e) {
                    // Do Nothing on Exception
                }
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $savePath = "/web_files/slider_image/";
            $path = public_path() . $savePath;
            $file->move($path, $fileName);
            $object->image = $savePath . $fileName;
        }

        if ($object->save()) {
            return Killa::responseSuccessWithMetaAndResult(
                200,
                200,
                'Slider updated successfully',
                $object
            );
        }

        return Killa::responseErrorWithMetaAndResult(
            500,
            500,
            'Failed to update slider',
            null
        );
    }


    public function store(Request $request)
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            // 'action' => 'nullable|string|max:255',
            // 'action_link' => 'nullable|url',
            // 'second_action' => 'nullable|string|max:255',
            // 'second_action_link' => 'nullable|url',
            'order' => 'required|integer',
            'image' => 'required|image',
            // 'icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
            $object = new MySlider();
            $object->title = $request->title;
            $object->description = $request->description;
            // $object->action = $request->action;
            // $object->action_link = $request->action_link;
            // $object->second_action = $request->second_action;
            // $object->second_action_link = $request->second_action_link;
            $object->order = $request->order;

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $savePath = "/web_files/slider_image/";
                $path = public_path() . $savePath;
                $file->move($path, $fileName);
                $object->image = $savePath . $fileName;
            }

            if ($object->save()) {
                return Killa::responseSuccessWithMetaAndResult(
                    201,
                    201,
                    'Slider created successfully',
                    $object
                );
            }

            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'Failed to save slider',
                null
            );
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'An error occurred while saving the slider',
                ['error' => $e->getMessage()]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $data = MySlider::findOrFail($id);

            // Handle image deletion
            if (!empty($data->image)) {
                $filePath = public_path($data->image);

                if (file_exists($filePath)) {
                    try {
                        unlink($filePath);
                    } catch (\Exception $e) {
                        // Log the exception if needed, but don't stop the process
                    }
                }
            }

            if ($data->delete()) {
                return Killa::responseSuccessWithMetaAndResult(
                    200,
                    200,
                    'Data deleted successfully',
                    null
                );
            }

            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'Failed to delete data',
                null
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Killa::responseErrorWithMetaAndResult(
                404,
                404,
                'Data not found',
                null
            );
        } catch (\Exception $e) {
            return Killa::responseErrorWithMetaAndResult(
                500,
                500,
                'An error occurred during deletion',
                ['error' => $e->getMessage()]
            );
        }
    }
}
