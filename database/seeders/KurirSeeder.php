<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {
            DB::table('kurirs')->insert([
                'nama'           => $faker->name,
                'no_telp'        => $faker->phoneNumber,
                'plat_kendaraan' => strtoupper($faker->bothify('? #### ??')),
                'level'          => $faker->numberBetween(1, 5),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
