<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        
        \App\Models\User::factory()->create([
            'name' => 'Org User',
            'email' => 'sgrgug@gmail.com',
            'password'  => '1',
            'role'  =>  'org',
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'sgr@gmail.com',
            'password'  => '1',
            'role'  =>  'org',
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'sagargurung@gmail.com',
            'password'  => '1',
            'role'  =>  'org',
        ]);

        
        \App\Models\User::factory()->create([
            'name' => 'a',
            'email' => 'a@gmail.com',
            'password'  => '1',
            'role'  =>  'user',
        ]);
        

        $this->call([
            CategorySeeder::class,
            EventSeeder::class,
            OrganizationSeeder::class,
        ]);
    }
}
