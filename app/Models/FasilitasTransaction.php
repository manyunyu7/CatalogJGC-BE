<?php
// app/Models/FasilitasTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FasilitasTransaction extends Model
{
    use HasFactory;
    // use SoftDeletes; // Enable soft deletes

    // Define the table associated with this model
    protected $table = 'fasilitas_transactions';

    // Define fillable columns for mass assignment
    protected $fillable = [
        'parent_id', // Plain column, not a foreign key
        'fasilitas_id',   // Foreign key to fasilitas table
        'created_by',
        'deleted_by',  // Ensure deleted_by is fillable
    ];

    // Define relationship with Fasilitas
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    }
}
