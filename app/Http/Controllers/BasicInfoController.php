<?php

namespace App\Http\Controllers;

use App\Models\MyBasicIdentity;
use Illuminate\Http\Request;

class BasicInfoController extends Controller
{
    public function index(Request $request){
        $data = MyBasicIdentity::all()->last();
        return view('basic_info.manage')->with(compact('data'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'motto' => 'required|string',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'office_hour' => 'required|string',
            'contact' => 'required|string',
            'misi' => 'required|string',
            'visi' => 'required|string',
        ]);

        // Check if a row already exists
        $existingRow = MyBasicIdentity::first();


        // If a row exists, update it; otherwise, create a new one
        if ($existingRow) {
            $existingRow->company_title = $request->title;
            $existingRow->company_motto = $request->motto;
            $existingRow->main_email = $request->email;
            $existingRow->main_address = $request->address;
            $existingRow->office_hour = $request->office_hour;
            $existingRow->contact = $request->contact;
            $existingRow->description = $request->description;
            $existingRow->vision = $request->visi;
            $existingRow->mission = $request->misi;
            $existingRow->save();
        } else {
            $newRow = new MyBasicIdentity();
            $newRow->company_title = $request->title;
            $newRow->company_motto = $request->motto;
            $newRow->main_email = $request->email;
            $newRow->main_address = $request->address;
            $newRow->office_hour = $request->office_hour;
            $newRow->contact = $request->contact;
            $newRow->description = $request->description;
            $newRow->vision = $request->visi;
            $newRow->mission = $request->misi;
            $newRow->save();
        }


        // Check if the save/update operation was successful
        $message = $existingRow ? 'Data updated successfully' : 'Data saved successfully';

        // Redirect back with a success or error message
        return back()->with($existingRow ? ["success" => $message] : ["success" => $message]);
    }
}
