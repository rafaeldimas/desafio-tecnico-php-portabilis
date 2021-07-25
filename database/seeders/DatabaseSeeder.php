<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeders = app()->environment('production')
            ? $this->seedersProduction()
            : $this->seedersDevelopment();

        $this->call($seeders);
    }

    /**
     * @return string[]
     */
    private function seedersProduction(): array
    {
        return [
            RoleSeeder::class,
        ];
    }

    /**
     * @return string[]
     */
    private function seedersDevelopment(): array
    {
        return [
            RoleSeeder::class,
        ];
    }
}
