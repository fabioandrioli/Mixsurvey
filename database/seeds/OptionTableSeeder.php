<?php

use Illuminate\Database\Seeder;
use App\Option;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([
            "title" => "Marcelo Roque",
            "description" => "Atual prefeito da cidade",
            "survey_id" => 1,
        ]);

        Option::create([
            "title" => "Adriano Ramos",
            "description" => "Atual vereador da cidade",
            "survey_id" => 1,
        ]);

        Option::create([
            "title" => "Arnaldo Maranhão",
            "description" => "Atual vice prefeito da cidade",
            "survey_id" => 1,
        ]);

        Option::create([
            "title" => "Adrianos Ramos",
            "description" => "Atual vereador da cidade",
            "survey_id" => 2,
        ]);

        Option::create([
            "title" => "Gilson Marcondes",
            "description" => "Atual vereador da cidade",
            "survey_id" => 2,
        ]);

        Option::create([
            "title" => "Marquinhos Roque",
            "description" => "Atual vereador da cidade",
            "survey_id" => 2,
        ]);
    }
}
