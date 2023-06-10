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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Sport',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Academic Competitions',
                'created_at' => Carbon::now(),
                
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Technical and Engineering',
                'created_at' => Carbon::now(),
                
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Social and Community',
                'created_at' => Carbon::now(),
                
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Gaming and Esports',
                'created_at' => Carbon::now(),
                
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Entrepreneurship and Business',
                'created_at' => Carbon::now(),
                
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Fashion and Lifestyle',
                'created_at' => Carbon::now(),
                
                'updated_at' => Carbon::now(),
            ],
            [
                'cat_name' => 'Other',
                'created_at' => Carbon::now(),
                
                'updated_at' => Carbon::now(),
            ],
        ];
    
        DB::table('categories')->insert($data);
    }
}
