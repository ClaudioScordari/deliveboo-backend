<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = config('users');

        foreach ($users as $user) {
            DB::table('users')->insert([
                'email' => $user['email'],
                'password' => $user['password'],
                'name' => $user['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
