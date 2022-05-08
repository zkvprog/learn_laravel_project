<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanHaveArticles()
    {
        $user = User::factory()->create();

        $attributes = Article::factory()->raw(['owner_id' => $user->id]);

        $user->articles()->create($attributes);

        $this->assertEquals($attributes['slug'], $user->articles->first()->slug);
    }
}
