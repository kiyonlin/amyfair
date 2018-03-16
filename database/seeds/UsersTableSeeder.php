<?php

use Illuminate\Database\Seeder;
use App\Modules\Auth\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();

        create(User::class, [
            'mobile' => 13675822217,
            'email'  => 'kiyonlin@163.com',
            'name'   => 'kiyon'
        ]);
    }
}
