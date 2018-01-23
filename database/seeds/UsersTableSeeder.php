<?php

use Illuminate\Database\Seeder;
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
        User::create([
            'name'     => 'Vanhack Admin',
            'email'    => 'admin@vanhackforum.com',
            'password' => bcrypt('123456'),
            'is_admin' => true
        ]);
    }
}
