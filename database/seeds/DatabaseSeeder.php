<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lets say we have 50 farmers in the database
        factory(\App\Models\FarmerInfo::class,50)->create();

        // Lets say averagely each farmer is involved in at least 10 enterprises
        factory(\App\Models\FarmerEnterprise::class,50*10)->create();

        // Lets say averagely each farmer have 10 pieces of lands
        factory(\App\Models\Land::class,50*10)->create();

        // Lets say each of the 500 Lands above have at least 4 documents each
        factory(\App\Models\LandDocument::class, 500 * 4 )->create();

        // Each of the 50 farmers in the database also has 1 bank account each
        factory(\App\Models\BankInfo::class, 50*1)->create();

    }
}
