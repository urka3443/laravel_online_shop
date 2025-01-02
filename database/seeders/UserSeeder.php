<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'user'],
        ]);

        DB::table('users')->insert([
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('12345678'),
           'role_id' => Role::where('name', 'admin')->first()->id,
        ]);
    }
}
