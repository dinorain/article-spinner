<?php

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
        $mode = $this->command->ask('Seed for production/testing (p/t)?', 'p');

        if ($mode === 'p') {
            $this->command->info("Seeding for production..");
            $this->call([
                UsersTableSeeder::class
            ]);
        } else if ($mode === 't') {
            $this->command->info("Seeding for testing..");
            $this->call([
                UsersTableSeeder::class,
                SpintaxInputsTableSeeder::class,
                SpintaxOutputsTableSeeder::class
            ]);
        }
    }
}
