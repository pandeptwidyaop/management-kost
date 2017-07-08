<?php

use Illuminate\Database\Seeder;
use App\Package;

class Packages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = File::get('database/_json/packages.json');
      $data = json_decode($json);
      foreach ($data as $row) {
        Package::create([
          'house_limit' => $row->house_limit,
          'room_limit' => $row->room_limit,
          'price' => $row->price,
          'description' => $row->description,
          'name' => $row->name
        ]);
      }
    }
}
