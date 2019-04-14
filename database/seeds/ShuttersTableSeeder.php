<?php

use Illuminate\Database\Seeder;

class ShuttersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Shutter::class, 10)->create();
    }
}
