<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class House extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('houses')->insert([
          [
            'userpackage_id' => 1,
            'name' => 'Jane House',
            'address' => 'Jalan Padang Sambian Barat',
            'created_at' => Carbon::now()
          ]
        ]);
    }
}
