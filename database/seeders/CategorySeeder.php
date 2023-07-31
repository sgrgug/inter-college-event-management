<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'cat_name' => 'Cultural',
                'slug'          => 'cultural',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Sport',
                'slug'          => 'sport',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Academic Competitions',
                'slug'          => 'academic-competitions',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Technical and Engineering',
                'slug'          => 'technical-and-engineering',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Social and Community',
                'slug'          => 'social-and-community',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Gaming and Esports',
                'slug'          => 'gaming-and-esports',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Entrepreneurship and Business',
                'slug'          => 'entrepreneurship-and-business',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Fashion and Lifestyle',
                'slug'          => 'fashion-and-lifestyle',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Other',
                'slug'          => 'other',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
    
        DB::table('categories')->insert($data);
    }
}
