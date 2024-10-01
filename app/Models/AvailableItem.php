<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'available'];

    // Relationship to Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
