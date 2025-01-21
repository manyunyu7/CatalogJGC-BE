<?php

namespace App\Http\Controllers;

use App\Models\MyBasicIdentity;
use App\Models\MyGallery;
use App\Models\OurClient;
use Illuminate\Http\Request;

class MyGalleryController extends Controller
{
    public function index(Request $request){
        $profile = MyBasicIdentity::all()->first();

        // Retrieve unique tags from the MyGallery table
        $uniqueTags = MyGallery::distinct()->pluck('tag')->toArray();

        // Transform tags into a new format, e.g., "filter-web"
        $tag_link = array_map(function ($tag) {
            return 'filter-' . str_replace(' ', '-', strtolower($tag));
        }, $uniqueTags);

        // Create a new object with 'tag' and 'tag_link' properties
        $tagObjects = array_map(function ($tag, $link) {
            return (object) ['tag' => $tag, 'tag_link' => $link];
        }, $uniqueTags, $tag_link);


        $datas = MyGallery::all();
        $compact = compact('uniqueTags', 'profile', 'tag_link', 'tagObjects','datas');

        if ($request->dump == true) {
            return $compact;
        }

        return view('profile.eterna.gallery.index')->with($compact);
    }


    public function getClientList(){
        return MyGallery::all();
    }

    public function manage(Request $request){
        $datas = MyGallery::orderBy('id')->get();
        $compact = compact('datas');

        if($request->dump==true){
            return $compact;
        }
        return view('my_gallery.manage')->with($compact);
    }

    public function viewEdit($id)
    {
        $data = MyGallery::where('id', '=', $id)->first();
        return view('my_gallery.edit')->with(compact('data'));
    }

    public function update(Request $request)
    {
        $object = MyGallery::findOrFail($request->id);
        $object->title = $request->title;
        $object->description = $request->description;
        $object->type = $request->action;
        $object->tag = $request->tag;

        if ($request->hasFile('media')) {

            // remove photo first
            $file_path = public_path() . $object->photo;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (\Exception $e) {
                    // Do Nothing on Exception
                }
            }

            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/media/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->image = $photoPath;
        }
        if ($object->save()) {
            return back()->with(["success" => "Data saved successfully"]);
        } else {
            return back()->with(["error" => "Saving process failed"]);
        }
    }


    public function store(Request $request)
    {
        $object = new MyGallery();
        $object->title = $request->title;
        $object->description = $request->description;
        $object->type = $request->action;
        $object->tag = $request->tag;
        if ($request->hasFile('media')) {

            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/media/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $object->image = $photoPath;
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
        $data = MyGallery::findOrFail($id);
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
