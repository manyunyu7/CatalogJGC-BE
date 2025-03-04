<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Model
{
    use HasFactory;

    // Disable timestamps auto management (if you want full control)
    // public $timestamps = true;

    protected $fillable = [
        'floor',
        'electricity',
        'description',
        'created_by',
        'updated_by',
        'map_embed_code',
        'land_length',
        'land_width',
        'building_length',
        'building_width',
    ];

    // Define model events
    protected static function booted()
    {
        static::creating(function ($productDetail) {
            // Automatically set the 'created_by' when creating a new record
            $productDetail->created_by = Auth::id(); // Get the logged-in user's ID
        });

        static::updating(function ($productDetail) {
            // Automatically set the 'updated_by' when updating an existing record
            $productDetail->updated_by = Auth::id(); // Get the logged-in user's ID
        });
    }

    public function getFloorAttribute($value)
    {
        return intval($value);
    }

    public function getLandLengthAttribute($value)
    {
        return intval($value);
    }

    public function getLandWidthAttribute($value)
    {
        return intval($value);
    }

    public function getBuildingLengthAttribute($value)
    {
        return intval($value);
    }

    public function getBuildingWidthAttribute($value)
    {
        return intval($value);
    }
}
