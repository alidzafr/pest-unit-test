<?php

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
