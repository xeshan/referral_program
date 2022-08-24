<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferralProgram;

class ReferralProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $user = ReferralProgram::create([
        	'name' => 'Sign-up Bonus', 
        	'uri' => 'register',
        ]);
    }
}
