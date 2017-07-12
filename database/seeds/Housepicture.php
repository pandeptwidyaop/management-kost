<?php

use Illuminate\Database\Seeder;
use App\Housepicture as Pict;

class Housepicture extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=1; $i <= 23 ; $i++) {
        $db = new Pict;
        $db->url = 'houses/'.$i.'.jpg';
        $db->house_id = 1;
        $db->save();
      }
    }
}
