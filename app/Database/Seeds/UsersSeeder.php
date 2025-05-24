<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UsersSeeder extends Seeder
{
   public function run()
   {
      $users = [
         [
            'name' => \base64_encode('User A'),
            'email' => \base64_encode('usera@test.com'),
            'password' => \base64_encode('123456'),
            'created_at' => Time::now()
         ],
         [
            'name' => \base64_encode('User B'),
            'email' => \base64_encode('userb@test.com'),
            'password' => \base64_encode('123456'),
            'created_at' => Time::now()
         ],
      ];

      $this->db->table('users')->insertBatch($users);
   }
}
