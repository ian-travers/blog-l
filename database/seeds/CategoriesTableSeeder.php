<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'title' => 'Web Design',
                'slug' => 'web-design',
            ],
            [
                'title' => 'Web Programming',
                'slug' => 'web-programming',
            ],
            [
                'title' => 'Internet',
                'slug' => 'internet',
            ],
            [
                'title' => 'SEO',
                'slug' => 'seo',
            ],
            [
                'title' => 'PHP Frameworks',
                'slug' => 'php-frameworks',
            ],
        ]);

        // update the posts data

        for ($post_id = 1; $post_id <= 10; $post_id++) {
            DB::table('posts')->where('id', $post_id)->update(['category_id' => rand(1, 5)]);
        }
    }
}
