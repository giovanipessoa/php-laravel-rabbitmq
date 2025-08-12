<?php

// src/Domain/Entities/Product.php
namespace AppCore\Domain\Entities;

use InvalidArgumentException;

class Product
{
    private ?int $id;
    private string $name;
    private ?string $description;
    private float $price;
    private int $stock;
    private bool $active;

    // set validations for the properties
    public function __construct(
        string $name,
        float $price,
        int $stock = 0,
        ?string $description = null,
        bool $active = true,
        ?int $id = null
    ) {
        if (empty($name)) {
            throw new InvalidArgumentException('Name is required');
        }
        if ($price < 0) {
            throw new InvalidArgumentException('Price must be greater than 0');
        }
        if ($stock < 0) {
            throw new InvalidArgumentException('Stock must be greater than 0');
        }

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->active = $active;
    }

    // set domain behavior methods
    public function decreaseStock(int $quantity): void
    {
        if ($this->stock < $quantity) {
            throw new InvalidArgumentException('Stock is not enough for the requested quantity');
        }
        $this->stock -= $quantity;
    }

    public function increaseStock(int $quantity): void
    {
        $this->stock += $quantity;
    }

    // set getters to access the properties
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
