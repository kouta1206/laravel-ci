<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
  use RefreshDatabase;

  public function testIndex()
  {
    $response = $this->get(route('articles.index'));

    $response->assertStatus(200)
        ->assertViewIs('articles.index');
  }

  public function testAuthCreate()
  {
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)
        ->get(route('articles.create'));

    $response->assertStatus(200)
        ->assertViewIs('articles.create');
  }

  public function testGuestCreate()
  {
    $response = $this->get(route('articles.create'));

    $response->assertRedirect(route('login'));
  }
}
