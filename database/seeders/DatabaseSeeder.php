<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
    // {
        $this->call([UsersTableSeeder::class]);
        \App\Models\User::factory(10)->create();
        // $user = User::factory(10)->create();

        \App\Models\Transaction::factory(10)->create();
    // }

    // $user = User::factory()->create([
    //     'name' => 'Kodego SP404',
    //     'username' => 'kodego',
    //     'email' => 'sp404@gmail.com',
    //     'password' => Hash::make('111'),

    // ]);

    // Transaction::factory(10)->create([
    //     'user_id' => $user->id
    // ]);
}
}
