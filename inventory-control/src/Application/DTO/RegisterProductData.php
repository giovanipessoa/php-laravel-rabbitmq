<?php

namespace AppCore\Application\DTO;

use Illuminate\Http\Request;

class RegisterProductData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
        public readonly float $price,
        public readonly int $stock,
        public readonly bool $active
    ) {}

    // a "factory method" to create the DTO from the request
    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('stock'),
            $request->input('active')
        );
    }
}
