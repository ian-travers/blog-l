<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        $faker = Faker\Factory::create();

        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'slug' => str_slug(str_random() . ' ' . 'John Doe'),
                'email' => 'johndoe@test.com',
                'bio' => $faker->text(rand(300, 400)),
                'password' => bcrypt('111'),
            ],
            [
                'name' => 'Jane Fonda',
                'slug' => str_slug(str_random() . ' ' . 'Jane Fonda'),
                'email' => 'janef@test.com',
                'bio' => $faker->text(rand(300, 400)),
                'password' => bcrypt('111'),
            ],
            [
                'name' => 'Ian Travers',
                'slug' => str_slug(str_random() . ' ' . 'Ian Travers'),
                'email' => 'iant@test.com',
                'bio' => $faker->text(rand(300, 400)),
                'password' => bcrypt('111'),
            ],
        ]);
    }
}
