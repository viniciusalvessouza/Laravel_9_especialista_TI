<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //esse user eh de uma model que o laravel cria por padrao
        User::create([
            'name'=>'Vinicius',
            'email'=>'viniciusalves.souza@yahoo.com.br',
            'password'=>bcrypt('12345678')
        ]);
    }
}
