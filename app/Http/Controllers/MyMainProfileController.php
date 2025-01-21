<?php

namespace App\Http\Controllers;

use App\Models\MyBasicIdentity;
use App\Models\MySlider;
use App\Models\OurBrand;
use App\Models\OurClient;
use Illuminate\Http\Request;

class MyMainProfileController extends Controller
{
    public function index(Request $request){
        $sliders = MySlider::orderBy('order')->get();
        $ourClients = OurClient::all();
        $ourBrands = OurBrand::all();
        $compact = compact('sliders','ourClients','ourBrands');


        if($request->dump==true){
            return $compact;
        }

        return view('profile.eterna.home.index')->with($compact);
    }
}
