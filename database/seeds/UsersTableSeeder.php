<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*User::create([
            'name' => 'admin',
            'email' => 'admin@demo.com',
            'type' => 'admin',
            'password' => Hash::make('demo'),
        ]);*/
        $user = User::whereEmail('rudy.ralison@arneg.com.pa')->first();
        $user->password = Hash::make('1234');
        $user->save();
    }
}
