<?php

use Illuminate\Database\Seeder;
use App\Modules\Auth\User;
use App\Modules\Auth\Admin;
use Laravel\Passport\Client;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Client::truncate();

        Client::create([
            'name'                   => 'Amyfair Password Grant Client',
            'secret'                 => 'bbU1j5crhfYoGMwwmC3webVndGxmUNPUDJ65YaJH',
            'redirect'               => 'http://localhost',
            'personal_access_client' => 0,
            'password_client'        => 1,
            'revoked'                => 0
        ]);

        User::truncate();

        create(User::class, [
            'mobile' => 13675822217,
            'email'  => 'kiyonlin@163.com',
            'name'   => 'kiyon'
        ]);

        create(User::class, [
            'mobile' => 13888888888,
            'email'  => 'kiyonlin@gmail.com',
            'name'   => 'admin',
            'admin'  => true
        ]);

        Admin::truncate();

        create(Admin::class, [
            'mobile' => 13675822217,
            'email'  => 'kiyonlin@163.com',
            'name'   => 'kiyon'
        ]);
    }
}
