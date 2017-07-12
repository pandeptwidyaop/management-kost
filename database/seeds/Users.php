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
          [//1
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'kost_owner',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          [//2
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'admin',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          [//3
            'name' => 'Pradipta Adi Nugraha',
            'email' => 'pradiptadipta31@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'tenant',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          [//4
            'name' => 'Dion Pratama Setiawan',
            'email' => 'dion.pratama88@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'tenant',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          [//5
            'name' => 'Agus Suarjana Putra',
            'email' => 'agussp244@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'tenant',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          [//6
            'name' => 'Pande Putu Widya Oktapratama',
            'email' => 'widya.oktapratama@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'tenant',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ],
          [//7
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Jalan Melati',
            'type' => 'tenant',
            'id_number' => '1234567890',
            'handphone' => '0987654321'
          ]
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
