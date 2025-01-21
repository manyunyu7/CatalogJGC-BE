<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyGallery extends Model
{
    use HasFactory;

    protected $appends = ["tag_link","full_image_path"];

    // Accessor method for the 'tag_link' attribute
    public function getTagLinkAttribute()
    {
        return 'filter-' . str_replace(' ', '-', strtolower($this->attributes['tag']));
    }

    public function getFullImagePathAttribute(){
        return url("/")."". $this->image;
    }

}
