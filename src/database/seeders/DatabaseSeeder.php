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
//         User::factory(1000)->create();

         $users = User::all();

         foreach ($users as $user) {
             $user->address_1 = fake()->address();
             $user->address_2 = rand(1, 100) > 88 ? fake()->address() : null;
             $user->save();
         }
        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
