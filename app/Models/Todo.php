<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    // This means don’t allow the columns values to get changed or added which we have mentioned in the array.
    protected $guarded = [];
}