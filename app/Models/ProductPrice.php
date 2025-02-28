<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = ["*"];
    protected $appends = ['formatted_price', 'price_with_prefix'];

    public function getPriceWithPrefixAttribute()
    {
        return "{$this->prefix} " . $this->formatted_price;
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }
}
