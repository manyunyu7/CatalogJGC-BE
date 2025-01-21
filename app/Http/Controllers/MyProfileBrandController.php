<?php

namespace App\Http\Controllers;

use App\Models\OurBrand;
use App\Models\OurClient;
use Illuminate\Http\Request;

class MyProfileBrandController extends Controller
{

    public function getBrandList(){
        return OurBrand::all();
    }
    public function manage(){
        $datas = OurBrand::orderBy('order')->get();
        $compact = compact('datas');
        return view('our_brand.manage')->with($compact);
    }

    public function viewEdit($id)
    {
        $data = OurBrand::where('id', '=', $id)->first();
        return view('our_brand.edit')->with(compact('data'));
    }

    public function update(Request $request)
    {
        $object = OurBrand::findOrFail($request->id);
        $object->title = $request->title;
        $object->description = $request->description;
        $object->action = $request->action;
        $object->action_link = $request->action_link;
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

            $savePath = "/web_files/our_brand/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->image = $photoPath;
        }


        if ($request->hasFile('poster')) {

            // remove photo first
            $file_path = public_path() . $object->poster;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (\Exception $e) {
                    // Do Nothing on Exception
                }
            }

            $file = $request->file('poster');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/our_brand/poster/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->poster = $photoPath;
        }


        if ($object->save()) {
            return back()->with(["success" => "Data saved successfully"]);
        } else {
            return back()->with(["error" => "Saving process failed"]);
        }
    }


    public function store(Request $request)
    {
        $object = new OurBrand();
        $object->title = $request->title;
        $object->description = $request->description;
        $object->action = $request->action;
        $object->action_link = $request->action_link;
        $object->order = $request->order;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/our_brand/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->image = $photoPath;
        }

        if ($request->hasFile('poster')) {

            $file = $request->file('poster');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/our_brand/poster/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->poster = $photoPath;
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
        $data = OurBrand::findOrFail($id);
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
