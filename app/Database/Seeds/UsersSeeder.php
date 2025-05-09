<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Config\Services;

class UsersSeeder extends Seeder
{
   public function run()
   {
      $users = [
         [
            'name' => \base64_encode('User A'),
            'email' => \base64_encode('usera@test.com'),
            'password' => \base64_encode('123456')
         ],
         [
            'name' => \base64_encode('User B'),
            'email' => \base64_encode('userb@test.com'),
            'password' => \base64_encode('123456')
         ],
         [
            'name' => \base64_encode('Leonardo Marcatti da Silva'),
            'email' => \base64_encode('leonardomarcatti@test.com'),
            'password' => \base64_encode('123456')
         ],
      ];

      $this->db->table('users')->insertBatch($users);
   }
}
