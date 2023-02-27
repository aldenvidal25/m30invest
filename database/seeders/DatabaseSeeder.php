<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFactory as FactoriesUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call([UsersTableSeeder::class]);
        // FactoriesUserFactory::factory(10)->create();
        // \App\Models\Factory::factory(10)->create();
        \App\Models\Transaction::factory(10)->create();
        // \App\Models\Transaction::factory(10)->create();
    }
}
