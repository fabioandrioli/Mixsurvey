<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fábio Gilberto Andrioli Gonçalves',
            'email' => 'fabio.drioli@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Larissa Soriani Barreto',
            'email' => 'lari.soriani@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Isadora Soriani Andrioli',
            'email' => 'isa.soriani@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Ana Clara Soriane Nunes',
            'email' => 'ana.soriani@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 2
        ]);
    }
}
