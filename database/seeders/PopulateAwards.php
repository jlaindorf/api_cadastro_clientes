<?php

namespace Database\Seeders;
use Faker\Factory;
use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopulateAwards extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) { // Altere 10 para o número desejado de registros
            Award::create([
                'description' => $faker->name(),
                'local' => $faker->text(),
                'value' => $faker->randomFloat(2, 100, 1000),
                'amount' => $faker->numberBetween(1, 5),
                'date' => $faker->date,
            ]);
        }

    }
}
