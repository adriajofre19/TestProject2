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


test('a user can create a course', function () {
    
    $user = User::factory()->create();
    
    $this->actingAs($user);

    $number_of_courses = Content::count();

    $response = $this->post(route('content.create'), [
        $content = [
            'title' => 'Course 1',
            'description' => 'Description of course 1',
            'visibility' => 1,
        ]
    ]);

    //$response->assertRedirect(route('cursos.index'));

    $this->assertEquals($number_of_courses + 1, Content::count());








});





