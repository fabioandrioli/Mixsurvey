<?php

use Illuminate\Database\Seeder;
use App\Newletter;

class EmailTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Newletter::create([
            'email' => 'fabio.drioli@gmail.com'
        ]);

        Newletter::create([
            'email' => 'fabio.tads15@gmail.com'
        ]);

        Newletter::create([
            'email' => 'teste@teste.com'
        ]);

        Newletter::create([
            'email' => 'aluizio@yahoo.com'
        ]);

        Newletter::create([
            'email' => 'azevedo.bomjesus@hotmail.com'
        ]);

        Newletter::create([
            'email' => 'luiz.henrique@hotmail.com'
        ]);
    }
}
