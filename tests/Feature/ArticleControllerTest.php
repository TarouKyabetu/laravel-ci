<?php

namespace Tests\Feature;

//==========ここから追加==========
use App\User;
//==========ここまで追加==========

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));
        
        $response->assertRedirect(route('login'));
    }
    //==========ここから追加==========
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertStatus(400) //200を400へ変更
            ->assertViewIs('articles.create');
    }
    //==========ここまで追加==========
}
