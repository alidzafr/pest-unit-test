<?php

use App\Models\Product;
use App\Models\User;

test('unauth user cannot access product', function () {
    $this->get('/product')
        ->assertRedirect('login');
});

test('empty table', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/product')
        ->assertSee('No Product Found');
});

test('homepage contain filled table', function () {
    $user = User::factory()->create();

    $product = Product::create([
        'name' => 'Rays TE37',
        'price' => 123
    ]);

    $this->actingAs($user)->get('/product')

        ->assertStatus(200)
        ->assertDontSee('No product found')

        // Check if html contain item named 'abs brake'
        ->assertSee('Rays TE37')
        // check if products table contain $product up there
        ->assertViewHas(
            'products',
            function ($collection) use ($product) {
                return $collection->contains($product);
            }
        );
});
