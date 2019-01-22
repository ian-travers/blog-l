<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->truncate();

        $posts = [];
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {

            $title = $faker->sentence(rand(8, 12));
            $image = "Post_Image_" . rand(1, 5) . ".jpg";
            $date = date('Y-m-d H:i:s', strtotime("2019-01-08 08:00:00 + {$i} days"));

            $posts[] = [
                'author_id' => rand(1, 3),
                'title' => $title,
                'excerpt' => $faker->text(rand(250, 350)),
                'body' => $faker->paragraph(rand(10, 12), true),
                'slug' => Str::slug(
                    mb_substr($title, 0, 50)
                    . '-'
                    . Carbon::now()->format('dmyHi')
                ),
                'image' => rand(0, 1) ? $image : null,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
