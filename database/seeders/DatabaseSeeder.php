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
        $this->call([
            PermissionsSeeder::class,
            AdminSeeder::class,
            SettingSeeder::class,
        ]);
        \App\Models\User::factory(20)->create();
        \App\Models\MainCategory::factory(10)->create();
        \App\Models\SubCategory::factory(20)->create();
        // \App\Models\Order::factory(20)->create();
    }
}
