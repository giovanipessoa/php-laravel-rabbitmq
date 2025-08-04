<?php

// app/Application/Repositories/IProductRepository.php
namespace App\Application\Repositories;

use App\Domain\Entities\Product;

interface IProductRepository
{
    public function save(Product $product): void;
    public function findAll(): array;
    public function findById(int $id): Product;
    public function delete(Product $product): void;
}
