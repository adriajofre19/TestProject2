<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Content;


test('get all courses', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user);

    $response = $this->get(route('contents.index'));

    $response->assertStatus(200);

    $response->assertInertia(fn ($page) => 
        $page->component('Content')
    );
});


test('user can delete a Curse', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/deleteCurse', [
            'id' => '1',
        ]);

    $response = $this->get(route('cursos.index'));

    $response->assertStatus(200);
});





