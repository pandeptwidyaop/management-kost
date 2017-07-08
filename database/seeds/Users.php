<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          [
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'kost_owner',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'admin',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          // JIKA MAU MENAMBAH DATA
          // [
          //   'name' => 'Jane Doe',
          //   'email' => 'janedoe@gmail.com',
          //   'password' => brcypt('123456'),
          //   'address' => 'Jalan Melati',
          //   'type' => 'kost_owner',
          //   'id_number' => '1234567890',
          //   'handphone' => '0987654321'
          // ]
        ]);
    }
}
