<?php

// app/Infrastructure/Persistence/EloquentProductRepository.php
namespace App\Infrastructure\Persistence;

use AppCore\Application\Repositories\InterfaceProductRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentProductModel;
use AppCore\Domain\Entities\Product;

class EloquentProductRepository implements InterfaceProductRepository
{
    public function save(Product $product): void
    {
        // the domain entity is received as an argument
        // the repository translates this entity to an Eloquent model
        $eloquentModel = $product->getId()
            ? EloquentProductModel::find($product->getId())
            : new EloquentProductModel();

        $eloquentModel->name = $product->getName();
        $eloquentModel->description = $product->getDescription();
        $eloquentModel->price = $product->getPrice();
        $eloquentModel->stock = $product->getStock();
        $eloquentModel->active = $product->isActive();

        $eloquentModel->save();
    }

    public function findAll(): array
    {
        $eloquentModels = EloquentProductModel::all();
        $products = [];

        foreach ($eloquentModels as $eloquentModel) {
            $products[] = new Product(
                $eloquentModel->name,
                $eloquentModel->price,
                $eloquentModel->stock,
                $eloquentModel->description,
                $eloquentModel->active,
                $eloquentModel->id
            );
        }

        return $products;
    }

    public function findById(int $id): ?Product
    {
        $eloquentModel = EloquentProductModel::find($id);

        if (!$eloquentModel) {
            return null;
        }

        return new Product(
            $eloquentModel->name,
            $eloquentModel->price,
            $eloquentModel->stock,
            $eloquentModel->description,
            $eloquentModel->active,
            $eloquentModel->id
        );
    }

    public function delete(Product $product): void
    {
        EloquentProductModel::destroy($product->getId());
    }
}
