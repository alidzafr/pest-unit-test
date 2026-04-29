<?php

use App\Models\Product;
use App\Models\User;
use Spatie\Permission\Models\Role;

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

test('paginated table', function () {
    $user = User::factory()->create();

    $products = Product::factory(11)->create();

    $lastProduct = $products->last();

    $this->actingAs($user)->get('/product')
        ->assertStatus(200)
        ->assertViewHas('products', function ($collection) use ($lastProduct) {
            return !$collection->contains($lastProduct);
        });
});

test('owner can access create', function () {
    $adminRole = Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole($adminRole);

    $this->actingAs($admin)->get('/product/create')
        ->assertStatus(200);
});

test('guest cannot access create', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/product/create')
        ->assertStatus(403);
});
