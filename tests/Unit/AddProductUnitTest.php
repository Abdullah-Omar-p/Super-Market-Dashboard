<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddProductUnitTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanAddAProduct()
    {
        // Arrange: Create the data for the new product
        $data = [
            'name' => 'Test Product',
            'barcode' => '123456789',
            'description' => 'Test description',
            'available_pices' => 10,
            'price' => 100,
        ];

        // Act: Call the method to add a product with the test data
        $product = Product::create($data);

        // Assert: Check if the product was created successfully
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['barcode'], $product->barcode);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['available_pices'], $product->available_pices);
        $this->assertEquals($data['price'], $product->price);
    }
}
