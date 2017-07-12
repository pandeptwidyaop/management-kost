<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Users::class);
        $this->call(Packages::class);
        $this->call(Userpackage::class);
        $this->call(House::class);
        $this->call(Housepicture::class);
        $this->call(Room::class);
        $this->call(Rental::class);
    }
}
