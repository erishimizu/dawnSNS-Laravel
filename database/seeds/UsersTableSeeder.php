<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'user01',
            'mail' => 'user01@dawn.jp',
            'password' => 'user01'
        ]);
    }
}
