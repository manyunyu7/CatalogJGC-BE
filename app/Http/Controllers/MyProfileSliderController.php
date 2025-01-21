<?php

namespace App\Http\Controllers;

use App\Models\MySlider;
use Illuminate\Http\Request;

class MyProfileSliderController extends Controller
{
    public function manageSlider(){
        $datas = MySlider::orderBy('order')->get();

        $compact = compact('datas');
        return view('slider.manage')->with($compact);
    }

    public function viewEdit($id)
    {
        $data = MySlider::where('id', '=', $id)->first();
        return view('slider.edit')->with(compact('data'));
    }



    public function update(Request $request)
    {
        $object = MySlider::findOrFail($request->id);
        $object->title = $request->title;
        $object->description = $request->description;
        $object->action = $request->action;
        $object->action_link = $request->action_link;
        $object->second_action = $request->second_action;
        $object->second_action_link = $request->second_action_link;
        $object->order = $request->order;

        if ($request->hasFile('image')) {

            // remove photo first
            $file_path = public_path() . $object->photo;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (\Exception $e) {
                    // Do Nothing on Exception
                }
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/slider_image/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->image = $photoPath;
        }

        if ($request->hasFile('icon')) {

            // remove photo first
            $file_path = public_path() . $object->icon;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (\Exception $e) {
                    // Do Nothing on Exception
                }
            }

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/slider_icon/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->icon = $photoPath;
        }
        if ($object->save()) {
            return back()->with(["success" => "Data saved successfully"]);
        } else {
            return back()->with(["error" => "Saving process failed"]);
        }
    }


    public function store(Request $request)
    {
        $object = new MySlider();
        $object->title = $request->title;
        $object->description = $request->description;
        $object->action = $request->action;
        $object->action_link = $request->action_link;
        $object->second_action = $request->second_action;
        $object->second_action_link = $request->second_action_link;
        $object->order = $request->order;
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/slider_image/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->image = $photoPath;
        }

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/slider_icon/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->icon = $photoPath;
        }

        if ($object->save()) {
            return back()->with(["success" => "Data saved successfully"]);
        } else {
            return back()->with(["error" => "Saving process failed"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MySlider::findOrFail($id);
        $file_path = public_path() . $data->image;


        if($data->image!=null || $data->image!=""){
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
                    // Do Nothing on Exception
                }
            }
        }

        if ($data->delete()) {
            return back()->with(["success" => "Data deleted successfully"]);
        } else {
            return back()->with(["error" => "Delete process failed"]);
        }
    }
}
