<?php

namespace App\Http\Controllers;

use App\Models\ContactWhatsapp;
use App\Models\OurClient;
use Illuminate\Http\Request;

class MyWhatsappController extends Controller
{

    public function getClientList(){
        return OurClient::all();
    }

    public function manage(){
        $datas = ContactWhatsapp::orderBy('created_at')->get();
        $compact = compact('datas');
        return view('whatsapp.manage')->with($compact);
    }

    public function viewEdit($id)
    {
        $data = ContactWhatsapp::where('id', '=', $id)->first();
        return view('whatsapp.edit')->with(compact('data'));
    }

    public function update(Request $request)
    {
        $object = ContactWhatsapp::findOrFail($request->id);
        $object->name = $request->name;
        $object->description = $request->description;
        $object->contact = $request->contact;
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

            $savePath = "/web_files/whatsapp/";
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
        $object = new ContactWhatsapp();
        $object->name = $request->name;
        $object->description = $request->description;
        $object->contact = $request->contact;
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/whatsapp/";
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
        $data = ContactWhatsapp::findOrFail($id);
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
