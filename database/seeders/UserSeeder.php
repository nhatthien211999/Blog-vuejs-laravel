<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Le Dao Nhat Thien',
            'email' => 'thien.ldn5368@sinhvien.hoasen.edu.vn',
            'role' => 'admin',
            'password' => Hash::make('123456789')
        ]);
    }
}
