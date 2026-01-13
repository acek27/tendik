<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'tendik@gmail.com',
                'password' => 'tendikj4y4',
            ],
        ];
        foreach ($data as $datum) {
            User::create($datum);
        }
    }
}
