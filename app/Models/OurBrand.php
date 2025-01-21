<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurBrand extends Model
{
    use HasFactory;
    protected $appends = ["full_image_path","full_poster_path"];


    // Define an accessor for the "full_img_path" attribute
    public function getFullPosterPathAttribute()
    {
        // Assuming you have an attribute called "image_filename" in your model
        $imageFilename = $this->poster;

        if ($imageFilename) {
            // You may adjust the path according to your file structure
            return asset("$imageFilename");
        }

        return null;
    }

    // Define an accessor for the "full_img_path" attribute
    public function getFullImagePathAttribute()
    {
        // Assuming you have an attribute called "image_filename" in your model
        $imageFilename = $this->image;

        if ($imageFilename) {
            // You may adjust the path according to your file structure
            return asset("$imageFilename");
        }

        return null;
    }
}
