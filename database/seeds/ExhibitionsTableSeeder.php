<?php

use Illuminate\Database\Seeder;
use App\Modules\Exhibition\Exhibition;

class ExhibitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Exhibition::truncate();

        create(Exhibition::class, 25);
    }
}
