<?php

namespace Tests\Unit\Application\UseCases;

use PHPUnit\Framework\TestCase;
use AppCore\Application\UseCases\RegisterProductUseCase;
use AppCore\Application\Repositories\InterfaceProductRepository;
use AppCore\Domain\Entities\Product;
use Mockery;

class RegisterProductUseCaseTest extends TestCase
{
    /**
     * @var InterfaceProductRepository|Mockery\MockInterface
     */
    protected $productRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepositoryMock = Mockery::mock(InterfaceProductRepository::class);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * test if the use case saves the product successfully
     *
     * @return void
     */
    public function testExecuteSavesProductSuccessfully()
    {
        $productData = [
            'name' => 'Caneta',
            'description' => 'Caneta Azul',
            'price' => 2.50,
            'stock' => 10,
        ];

        $this->productRepositoryMock->shouldReceive('save')
            ->once()
            ->withArgs(function (Product $product) use ($productData) {
                return $product->getName() === $productData['name'] &&
                    $product->getPrice() === $productData['price'];
            });

        $useCase = new RegisterProductUseCase($this->productRepositoryMock);
        $product = $useCase->execute($productData);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($productData['name'], $product->getName());
    }
}
