<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OperatorSeeder extends Seeder
{
    public function run(): void
    {
        $operators = [
            [
                'name' => 'Nicola',
                'surname' => 'Loiodice',
                'email' => 'nicola@nicola.it',
                'password' => 'nicola98',
            ],
            [
                'name' => 'Cataldo',
                'surname' => 'Balducci',
                'email' => 'cataldo@cataldo.it',
                'password' => 'cataldo98',
            ],
        ];

        foreach ($operators as $op) {
            User::create([
                'name' => $op['name'],
                'surname' => $op['surname'],
                'email' => $op['email'],
                'role' => 'Operatore',
                'password' => Hash::make($op['password']),
            ]);
        }
    }
}
