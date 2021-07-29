<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert(['id' => 1],
            [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@3sixtyfactory.com',
                'email_verified_at' => now(),
                'password' => bcrypt('test12345'),
                'created_at' => now()
            ]);
    }
}
