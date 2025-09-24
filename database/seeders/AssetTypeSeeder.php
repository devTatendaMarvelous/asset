<?php

namespace Database\Seeders;

use App\Models\AssetType;
use App\Traits\Core;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetTypeSeeder extends Seeder
{
    use Core;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getAssetTypes() as $assetType) {
            if (AssetType::where('name', $assetType)->doesntExist()) {
                AssetType::create(['name' => $assetType,'description' => $assetType]);
            }
        }
    }
}
