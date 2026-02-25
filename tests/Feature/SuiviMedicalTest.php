<?php

use App\Models\User;

test('un utilisateur peut accéder à la page des suivis médicaux', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/suivi');
    $response->assertStatus(200);
});

test('un utilisateur peut accéder au formulaire de création de suivi', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/suivi/create');
    $response->assertStatus(200);
});

test('un visiteur non authentifié ne peut pas accéder aux suivis', function () {
    $response = $this->get('/suivi');
    $response->assertRedirect(route('login'));
});
