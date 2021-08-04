<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'Prefeito',
            'description' => 'Categoria de prefeitos',
            'slug' => 'Prefeito',
            'user_id' => 1,
        ]);

        Category::create([
            'title' => 'Senador',
            'description' => 'Categoria de Senadores',
            'slug' => 'Senador',
            'user_id' => 1,
        ]);

        Category::create([
            'title' => 'Presidente',
            'description' => 'Categoria de Presidentes',
            'slug' => 'Presidente',
            'user_id' => 1,
        ]);

        Category::create([
            'title' => 'Vereador',
            'description' => 'Categoria de Vereadores',
            'slug' => 'Vereador',
            'user_id' => 1,
        ]);
    }
}
