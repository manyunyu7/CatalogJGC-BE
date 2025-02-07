<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;

    // Specify the table name (optional if the table name follows Laravel's convention)
    protected $table = 'product_images';

    // Allow mass-assignment for the specified fields
    protected $fillable = [
        'position', // for reordering
        'type',
        'description',
        'created_by',
        'parent_id', // This is the reference to the parent product
        'image_path', // The path to the image file in storage
    ];


    protected $appends = ["full_image_path"];
    public function getFullImagePathAttribute(){
        return url("/")."". $this->image_path;
    }

    // Automatically set `created_by` before saving
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($productImage) {
            if (Auth::check()) {
                $productImage->created_by = Auth::id();
            }
        });
    }


    // Use soft delete feature
    protected $dates = ['deleted_at'];

    // Define a relationship if needed (e.g., belongs to Product model)
    public function product()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }
}
