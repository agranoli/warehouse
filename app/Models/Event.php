<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Ensure the fillable fields match your database column names
    protected $fillable = ['name', 'date_from', 'date_to', 'file'];
}
