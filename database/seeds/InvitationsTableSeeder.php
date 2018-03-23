<?php

use Illuminate\Database\Seeder;
use App\Modules\Invitation\Invitation;

class InvitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Invitation::truncate();

        create(Invitation::class, 25);
    }
}
