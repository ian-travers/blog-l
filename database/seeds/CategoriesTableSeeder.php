<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'title' => 'Uncategorize',
                'slug' => 'uncategorize',
            ],
            [
                'title' => 'Tips and Tricks',
                'slug' => 'tips-and-tricks',
            ],
            [
                'title' => 'Build Apps',
                'slug' => 'build-apps',
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
        $categories = Category::pluck('id');

        foreach (Post::pluck('id') as $postId)
        {
            $categoryId = $categories[rand(0, $categories->count()-1)];

            DB::table('posts')
                ->where('id', $postId)
                ->update(['category_id' => $categoryId]);
        }
    }
}
