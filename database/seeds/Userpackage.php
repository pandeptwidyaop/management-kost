<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Userpackage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('userpackages')->insert([
        [//1
          'user_id' => '1',
          'package_id' => '2',
          'registered' => Carbon::now(),
          'expired' => Carbon::now()->addMonths(1)
        ]
      ]);
    }
}
