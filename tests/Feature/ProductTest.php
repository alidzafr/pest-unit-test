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

test('create product success', function () {
    $adminRole = Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole($adminRole);

    $product = [
        'name' => 'Work',
        'price' => '400'
    ];

    $this->actingAs($admin)
        ->post('/product', $product)
        ->assertStatus(302)
        ->assertRedirect('product');

    $this->assertDatabaseHas('products', $product);

    $lastProduct = Product::latest()->first();
    expect($lastProduct->name)->toBe($product['name']);
    expect($lastProduct->price)->toBeInt($product['price']);
});

test('edit contains correct value', function () {
    $adminRole = Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole($adminRole);

    $product = Product::factory()->create();

    $this->actingAs($admin)
        ->get('product/edit/' . $product->id)
        ->assertStatus(200)
        ->assertSee('value="' . $product->name . '"', false)
        ->assertSee('value="' . $product->price . '"', false);
});

test('validation error redirect to form', function () {
    $adminRole = Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole($adminRole);

    $product = Product::factory()->create();

    $this->actingAs($admin)
        ->put('product/edit/' . $product->id, [
            'name' => '',
            'price' => ''
        ])
        ->assertStatus(302)
        ->assertInvalid(['name', 'price']);
});

test('delete product', function () {
    $adminRole = Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole($adminRole);

    $product = Product::factory()->create();

    $this->actingAs($admin)
        ->delete('product/delete/' . $product->id)
        ->assertStatus(302)
        ->assertRedirect('product');

    $this->assertDatabaseMissing('products', $product->toArray());
});
