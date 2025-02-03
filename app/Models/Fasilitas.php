<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fasilitas extends Model
{

    use SoftDeletes; // Enable soft deletes
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'fasilitas';

    // Append the new attribute to the model
    protected $appends = ['img_full_path'];

    // Accessor for the new attribute
    public function getImgFullPathAttribute()
    {
        return url("").$this->icon;
    }

    // Define fillable columns for mass assignment
    protected $fillable = [
        'icon',
        'name',
        'description',
    ];

    // Define relationship with FasilitasTransaction
    public function transactions()
    {
        return $this->hasMany(FasilitasTransaction::class, 'icon_id');
    }
}
