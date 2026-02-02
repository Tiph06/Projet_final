<?php

use App\Models\User;

test('un utilisateur authentifié peut créer un témoignage', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('/temoignages', [
        'categorie' => 'Diagnostic',
        'content' => 'Mon parcours avec l\'endométriose a commencé il y a 5 ans...',
    ])
        ->assertRedirect();

    $this->assertDatabaseHas('post_temoignages', [
        'categorie' => 'Diagnostic',
        'content' => 'Mon parcours avec l\'endométriose a commencé il y a 5 ans...',
    ]);
});

test('un témoignage nécessite une validation', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('/temoignages', [
        'categorie' => '',
        'content' => '',
    ])
        ->assertSessionHasErrors(['categorie', 'content']);
});

test('un visiteur non connecté ne peut pas créer de témoignage', function () {
    $this->post('/temoignages', [
        'categorie' => 'Diagnostic',
        'content' => 'Test de contenu',
    ])
        ->assertRedirect('/login');
});
