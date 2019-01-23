<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;


class PostsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->truncate();

        $posts = [];
        $faker = Faker\Factory::create();
        $date = Carbon::create(2019, 1, 10, 8, 45);

        for ($i = 1; $i <= 10; $i++) {

            $title = $faker->sentence(rand(8, 12));
            $image = "Post_Image_" . rand(1, 5) . ".jpg";
//            $date = date('Y-m-d H:i:s', strtotime("2019-01-08 08:00:00 + {$i} days"));
            $date->addDay(1);
            $publishedDate = clone($date);
            $createdDate = Clone($date);

            $posts[] = [
                'author_id' => rand(1, 3),
                'title' => $title,
                'excerpt' => $faker->text(rand(250, 350)),
                'body' => $faker->paragraphs(rand(8, 12), true),
                'slug' => str_slug(
                    mb_substr($title, 0, 50)
                    . '-'
                    . Carbon::now()->format('dmyHi')
                ),
                'image' => rand(0, 1) ? $image : null,
                'category_id' => 0,
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
                'published_at' => $i > 4 && rand(0, 1) == 0 ? null : $publishedDate->addDay($i + rand(3, 5)),
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
