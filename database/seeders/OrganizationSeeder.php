<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'user_id'       =>  1,
            'name'          =>  'GCES',
            'description'   =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut illum consequuntur harum, atque dolore dolor omnis explicabo aliquid nulla id.',
            'photo'         =>  'gces-expo-9th-1690299480.jpg',
            'location'      =>  'Kathmandu, Nepal',
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now(),
        ];

        \DB::table('organizations')->insert($data);
    }
}
