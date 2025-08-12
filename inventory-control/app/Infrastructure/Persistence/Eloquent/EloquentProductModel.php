<?php

// app/Infrastructure/Persistence/Eloquent/EloquentProductModel.php
namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentProductModel extends Model
{
    // set the factory to use the model
    use HasFactory;

    // set the table name
    protected $table = 'products';

    // set the fillable fields
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'active'
    ];
}
