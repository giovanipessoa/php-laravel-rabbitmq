<?php

// app/Application/UseCases/RegisterProductUseCase.php
namespace App\Application\UseCases;

use App\Application\Repositories\IProductRepository;
use App\Domain\Entities\Product;
use InvalidArgumentException;

class RegisterProductUseCase
{
    public function __construct(private IProductRepository $productRepository) {}

    public function execute(array $productData): Product
    {
        try {
            if (empty($productData['name'])) {
                throw new InvalidArgumentException("Name is required");
            }

            if ($productData['price'] < 0) {
                throw new InvalidArgumentException("Price must be greater than 0");
            }

            if ($productData['stock'] < 0) {
                throw new InvalidArgumentException("Stock must be greater than 0");
            }

            $product = new Product([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'active' => true
            ]);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }

        $this->productRepository->save($product);
        return $product;
    }
}
