<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = [
            [
               'name'=>'Admin',
               'gender'=>'female',
               'email'=>'admin@laravelia.com',
                'type'=>'1',
                'date_of_birth'=>'1000-01-01',
               'password'=> bcrypt('secret'),
            ],
            [
               'name'=>'User',
               'gender'=>'female',
               'email'=>'user@laravelia.com',
                'type'=>'0',
                'date_of_birth'=>'1000-01-01',
               'password'=> bcrypt('secret'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
