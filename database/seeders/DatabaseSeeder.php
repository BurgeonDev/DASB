<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run lookup tables
        $this->call([
            AdminSeeder::class,
            RankSeeder::class,
            PensionCategorySeeder::class,
            RegtCorpsSeeder::class,
            StatusSeeder::class,
            PensionerImportSeeder::class,
        ]);
    }
}
