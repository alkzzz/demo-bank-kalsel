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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();
        DB::table('nasabahs')->truncate();

        $faker = Faker\Factory::create('id_ID');

        for ($i=1; $i <= 5 ; $i++) { 
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'username' => 'marketing'.$i,
                'password' => bcrypt(12345)
            ]);
        }

        // $tabungan = [
        //     2500000, 
        //     5000000, 
        //     15000000, 
        //     25000000, 
        //     35000000, 
        //     45000000, 
        //     55000000, 
        //     65000000, 
        //     75000000, 
        //     85000000, 
        //     95000000, 
        //     100000000,
        //     200000000,
        //     300000000,
        //     400000000,
        //     500000000,
        //     1000000000,
        //     10000000000,
        //     50000000000,
        //     100000000000,
        // ];

        // for ($i=0; $i < 25; $i++) { 
        //     DB::table('nasabahs')->insert([
        //         'name' => $faker->name,
        //         'user_id' => $faker->numberBetween(1, 5),
        //         'tabungan' => $faker->randomElement($tabungan) 
        //     ]);
        // }
        

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
