<?php

use Illuminate\Database\Seeder;

class RollerBlindsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\RollerBlind::class, 10)->create();
    }
}
