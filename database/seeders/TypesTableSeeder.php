<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = config('types');
        
        foreach ($types as $type) {
            DB::table('types')->insert([
                'name' => $type['name'],
                'icon' => $type['icon'],
            ]);
        }
    }
}
