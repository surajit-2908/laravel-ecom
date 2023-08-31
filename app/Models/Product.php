<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\UsesUuid;

class Product extends Model
{
    use UsesUuid;
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'image',
        'category',
        'price',
        'status'
    ];
}
