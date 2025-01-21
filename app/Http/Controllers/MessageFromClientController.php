<?php

namespace App\Http\Controllers;

use App\Models\MessageFromClient;
use Illuminate\Http\Request;

class MessageFromClientController extends Controller
{

    public function manage(Request $request){
        $datas = MessageFromClient::orderBy("created_at","desc")->get();
        return view('inbox/manage')->with(compact('datas'));
    }

    public function store(Request $request)
    {
        try {
            // Create a new instance of MessageFromClient model
            $data = new MessageFromClient();

            // Assign validated data to model properties
            $data->name = $request->name;
            $data->email = $request->email;
            $data->subject = $request->subject;
            $data->message = $request->message;

            // Save the data to the database
            $data->save();

            // Return a success response or any additional data you want to include
            return response()->json(['message' => 'Message saved successfully'], 200);
        } catch (\Exception $e) {
            // Handle exceptions, log the error, and return an error response
//            \Log::error('Error saving message: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the message'], 500);
        }
    }
}
