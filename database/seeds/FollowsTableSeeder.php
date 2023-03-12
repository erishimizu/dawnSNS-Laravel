<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            [
                'follow' => '3',
                'follower' => '2',
                'created_at' => '2021-3-1 18:35:48',
            ],
            [
                'follow' => '4',
                'follower' => '2',
                'created_at' => '2021-3-1 18:35:48',
            ],
            [
                'follow' => '5',
                'follower' => '2',
                'created_at' => '2021-3-1 18:35:48',
            ],
        ]);
    }
}
