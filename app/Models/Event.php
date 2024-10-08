<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['nosaukums', 'datums_no', 'datums_lidz', 'file'];

    // Many-to-many relationship with User
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
