<?php

// src/Application/UseCases/RegisterProductUseCase.php
namespace AppCore\Application\UseCases;

use AppCore\Application\Repositories\InterfaceProductRepository;
use AppCore\Domain\Entities\Product;
use InvalidArgumentException;

class RegisterProductUseCase
{
    public function __construct(private InterfaceProductRepository $productRepository) {}

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

            $product = new Product(
                $productData['name'],
                $productData['price'],
                $productData['stock'],
                $productData['description'],
                true
            );

            $this->productRepository->save($product);
            return $product;
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
