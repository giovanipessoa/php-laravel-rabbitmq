<?php

// app/Domain/Entities/Product.php
namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Product extends Model
{
    use HasFactory;

    // fillable to specify the fields that can be mass assigned

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'active',
    ];

    // behavior methods to the domain

    public function increaseStock(int $quantity): void
    {
        $this->stock += $quantity;
    }

    public function decreaseStock(int $quantity): void
    {
        if ($this->stock < $quantity) {
            throw new InvalidArgumentException('Stock is not enough');
        }

        $this->stock -= $quantity;
    }

    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }
}
