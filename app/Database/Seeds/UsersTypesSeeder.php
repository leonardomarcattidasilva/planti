<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersTypesSeeder extends Seeder
{
   public function run()
   {
      $seeds = [
         ['id_user' => 1, 'id_type' => 5],
         ['id_user' => 2, 'id_type' => 4],
         ['id_user' => 3, 'id_type' => 3],
         ['id_user' => 1, 'id_type' => 2],
         ['id_user' => 2, 'id_type' => 1],
      ];

      $this->db->table('users_types')->insertBatch($seeds);
   }
}
