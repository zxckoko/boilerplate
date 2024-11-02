<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private $defaultUserPassword = 'y^x479$vRSJzuu6$4G8w';
    private $defaultUserName = 'KOKO';
    private $defaultUserEmail = 'koko@example.com';
    private $defaultUserCount = 999;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => $this->defaultUserName,
            'email' => $this->defaultUserEmail,
            'password' => Hash::make($this->defaultUserPassword),

        ]);

        User::factory($this->defaultUserCount)->create();

        $this->call(ArticleSeeder::class);

        $this->command->info('Users, Articles seeded successfully!' . ' : ' . now());
    }
}
