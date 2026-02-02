<?php

use App\Models\User;

test('un utilisateur peut se connecter et accéder au dashboard', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(200);
});

test('un visiteur non authentifié ne peut pas accéder au dashboard', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect(route('login'));
});

test('la page de login existe', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});
