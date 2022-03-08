<?php
// database/seeders/DatabaseSeeder.php
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
        $this->call(array(
            AdminSeeder::class,
            UserSeeder::class,
            MarketSeeder::class,
            ProductSeeder::class,
        ));
    }
}
