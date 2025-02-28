<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MySlider extends Model
{
    use HasFactory;

    protected $appends = ["full_img_path"]; // Fix the property name

    public function getFullImgPathAttribute()
    {
        return url('/') . '/' . ltrim($this->image, '/'); // Ensure correct URL format
    }
}
