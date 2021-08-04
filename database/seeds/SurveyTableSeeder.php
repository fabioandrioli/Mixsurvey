<?php

use Illuminate\Database\Seeder;
use App\Survey;
use Illuminate\Support\Facades\Date;

class SurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Survey::create([
            "title" => "Vote nos possíveis candidatos a prefeito",
            "slug" => "Vote-nos-possíveis-candidatos-a-prefeito",
            "description" => "Possiveis candidatos para paranaguá",
            "start_date" => "2020-06-12",
            "finish_date" => "2020-06-12",
            "user_id" => 1,
            "category_id" => 1,
        ]);

        Survey::create([
            "title" => "Vote nos possíveis candidatos a vereador",
            "slug" => "Vote-nos-possíveis-candidatos-a-vereador",
            "description" => "Possiveis candidatos para paranaguá",
            "start_date" => "2020-06-12",
            "finish_date" => "2020-06-12",
            "user_id" => 1,
            "category_id" => 1,
        ]);

        Survey::create([
            "title" => "Candidatos a presidencia",
            "slug" => "Candidatos-a-presidencia",
            "description" => "Possiveis presidentes",
            "start_date" => "2020-06-12",
            "finish_date" => "2020-06-12",
            "user_id" => 1,
            "category_id" => 1,
        ]);

        Survey::create([
            "title" => "Qual o melhor projetos entre os vereadores",
            "slug" => "Qual-o-melhor-projetos-entre-os-vereadores",
            "description" => "Projetos aprovados pela camara.",
            "start_date" => "2020-06-12",
            "finish_date" => "2020-06-12",
            "user_id" => 1,
            "category_id" => 1,
        ]);
    }
}
