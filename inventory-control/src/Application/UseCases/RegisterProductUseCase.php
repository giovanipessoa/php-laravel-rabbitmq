<?php

// src/Application/UseCases/RegisterProductUseCase.php
namespace AppCore\Application\UseCases;

use AppCore\Application\Repositories\InterfaceProductRepository;
use AppCore\Application\DTO\RegisterProductData;
use AppCore\Domain\Entities\Product;

class RegisterProductUseCase
{
    public function __construct(private InterfaceProductRepository $productRepository) {}

    public function execute(RegisterProductData $data): Product
    {
        $product = new Product(
            $data->name,
            $data->description,
            $data->price,
            $data->stock,
            true
        );

        $this->productRepository->save($product);
        return $product;
    }
}
