<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory()->count(10)->create();
        $tagsIds = $tags->pluck('id');

        User::factory()->count(2)->create()->each(function ($user) use ($tagsIds) {
            Article::factory()
                ->count(10)
                ->create(['owner_id' => $user->id])
                ->each(function ($article) use ($tagsIds) {
                    $article->tags()->sync($tagsIds->random(mt_rand(1, 4)));
                })
            ;
        });
    }
}
