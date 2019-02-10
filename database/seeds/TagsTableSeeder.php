<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('post_tag')->truncate();
        DB::table('tags')->truncate();

        $php = new Tag();
        $php->name = 'PHP';
        $php->slug = 'php';
        $php->save();

        $laravel = new Tag();
        $laravel->name = 'Laravel';
        $laravel->slug = 'laravel';
        $laravel->save();

        $symfony = new Tag();
        $symfony->name = 'Symfony';
        $symfony->slug = 'symfony';
        $symfony->save();

        $yii = new Tag();
        $yii->name = 'Yii';
        $yii->slug = 'yii';
        $yii->save();

        $vue = new Tag();
        $vue->name = 'Vue JS';
        $vue->slug = 'vue-js';
        $vue->save();

        $tags = [
            $php->id,
            $laravel->id,
            $symfony->id,
            $yii->id,
            $vue->id,
        ];

        foreach (Post::all() as $post) {
            shuffle($tags);

            for ($i = 0; $i <= rand(1, 4); $i++) {
                $post->tags()->detach($tags[$i]);
                $post->tags()->attach($tags[$i]);
            }
        }
    }
}
