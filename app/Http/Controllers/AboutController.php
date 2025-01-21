<?php

namespace App\Http\Controllers;

use App\Models\MyBasicIdentity;
use App\Models\OurClient;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about(){
        $profile = MyBasicIdentity::all()->first();
        $ourClients = OurClient::all();
        return view('profile.eterna.about.index')->with(compact('profile','ourClients'));
    }
}
