<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            "title" => "Webmaster",
            "description" => "Realiza qualquer função no sistema. Usuario exclusivo",
        ]);

        Role::create([
            "title" => "Adiministrador",
            "description" => "Administra criação edicao e exclusao de enquetes.",
        ]);

        Role::create([
            "title" => "Convidado",
            "description" => "Pode votar em enquetes que necessitam de login",
        ]);
    }
}
