<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::whereEmail('teekay@staff.msu.ac.zw')->doesntExist()) {
            User::create([
                'name' => 'Admin',
                'email' => 'teekay@staff.msu.ac.zw',
                'password' => Hash::make('password'),
            ]);
        }
        $this->call([
            AssetTypeSeeder::class,
        ]);
    }
}
