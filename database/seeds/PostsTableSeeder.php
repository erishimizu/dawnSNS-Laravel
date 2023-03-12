<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => '2',
                'posts' => 'seederによる投稿1',
                'created_at' => '2021-3-1 18:35:48',
                'updated_at' => '2021-3-1 18:35:48',
            ],
            [
                'user_id' => '2',
                'posts' => 'seederによる投稿2',
                'created_at' => '2021-3-1 18:35:48',
                'updated_at' => '2021-3-1 18:35:48',
            ],
        ]);
    }
}
