<?php

// src/Application/Repositories/InterfaceProductRepository.php
namespace AppCore\Application\Repositories;

use AppCore\Domain\Entities\Product;

interface InterfaceProductRepository
{
    public function save(Product $product): void;
    public function findAll(): array;
    public function findById(int $id): ?Product;
    public function delete(Product $product): void;
}
