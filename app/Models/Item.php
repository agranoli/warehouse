<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'quantity', 'price', 'img'];

    // Define the relationship with AvailableItem
    public function availableItem()
    {
        return $this->hasOne(AvailableItem::class);
    }

    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
