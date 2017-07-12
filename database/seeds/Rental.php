<?php

use Illuminate\Database\Seeder;
use App\Rental as R;
use Carbon\Carbon;

class Rental extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = 3;
        for ($i=1; $i <= 5 ; $i++) {
          $r = new R;
          $r->room_id = $i;
          $r->user_id = $user;
          $r->date = Carbon::now();
          $r->save();
          $user++;
        }
    }
}
