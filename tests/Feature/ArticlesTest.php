<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanCreateArticle()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create());

        $attributes = Article::factory()->raw(['owner_id' => $user]);
        $this->post('/articles', $attributes);

        $this->assertDatabaseHas('articles', $attributes);
    }

    public function testGeuestCanNotCreateArticle()
    {
        $this->post('/articles', [])->assertRedirect('/login');
    }
}
