<?php

use Illuminate\Database\Seeder;
use App\Room as R;

class Room extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 7; $i++) {
          $r = new R;
          $r->house_id = 1;
          $r->number = $i;
          $r->facility = '<ul><li>Spring Bad</li><li>AC</li><li>TV</li><li>Gym</li><li>Pool</li>
                          <li>Parkir Mobil</li>
                          <li>Badhub</li>
                          <li>Kitchen Set</li>
                          <li>Wifi 40mb</li>
                          <li>Playstation IV</li>
                          </ul>';
          $r->price = 1600000;
          $r->save();
        }
    }
}
