<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user = User::where('email','admin@domain.local')->first();
        if ($user){
            $user->password = bcrypt('admink@lsel25');
            $user->username = 'adminkalsel';
            $user->save();
        }
    }
}
