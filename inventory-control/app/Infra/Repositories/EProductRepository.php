<?php

// app/Infra/Repositories/EProductRepository.php
namespace App\Infra\Repositories;

use App\Application\Repositories\IProductRepository;
use App\Domain\Entities\Product;

class EProductRepository implements IProductRepository
{
    public function save(Product $product): void
    {
        $product->save();
    }

    public function findAll(): array
    {
        return Product::all()->all();
    }

    public function findById(int $id): Product
    {
        return Product::find($id);
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
