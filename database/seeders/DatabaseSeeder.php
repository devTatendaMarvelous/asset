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
        if (User::whereEmail('admin@asset.com')->doesntExist()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@asset.com',
                'password' => Hash::make('password'),
            ]);
        }
        $this->call([
            AssetTypeSeeder::class,
        ]);
    }
}
