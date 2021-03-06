<?php

use App\Comment;
use App\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->truncate();

        $faker = Factory::create();
        $comments = [];

        $posts = Post::published()->get();
        /* @var Post $post */
        foreach ($posts as $post) {
            for ($i = 1; $i <= rand(1, 10); $i++) {

                $commentDate = $post->published_at->modify("+{$i} hours");

                $comments[] = [
                    'author_name' => $faker->name,
                    'author_email' => $faker->email,
                    'author_url' => $faker->domainName,
                    'body' =>$faker->paragraphs(rand(1, 5), true),
                    'post_id' => $post->id,
                    'created_at' => $commentDate,
                    'updated_at' => $commentDate,
                ];
            }
        }

        Comment::insert($comments);
    }
}
