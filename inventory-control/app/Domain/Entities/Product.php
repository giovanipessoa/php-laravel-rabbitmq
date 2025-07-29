<?php

// app/Domain/Entities/Product.php
namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'active',
    ];

    // methods for domain behavior

    public function increaseStock(int $quantity): void
    {
        $this->stock += $quantity;
    }

    public function decreaseStock(int $quantity): void
    {
        if ($this->stock < $quantity) {
            throw new \InvalidArgumentException('Stock is not enough');
        }

        $this->stock -= $quantity;
    }

    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }
}
