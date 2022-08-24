<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'admin',
    		'email' => 'admin@admin.com',
    		'role' => 'admin',
    		'password' => Hash::make('admin123'),
        ]);
    }
}
