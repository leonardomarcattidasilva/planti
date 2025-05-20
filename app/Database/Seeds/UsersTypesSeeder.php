<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UsersTypesSeeder extends Seeder
{
   public function run()
   {
      $seeds = [
         ['id_user' => 1, 'id_type' => 5, 'created_at' => Time::now()],
         ['id_user' => 2, 'id_type' => 4, 'created_at' => Time::now()],
         ['id_user' => 3, 'id_type' => 3, 'created_at' => Time::now()],
         ['id_user' => 1, 'id_type' => 2, 'created_at' => Time::now()],
         ['id_user' => 2, 'id_type' => 1, 'created_at' => Time::now()],
      ];

      $this->db->table('users_types')->insertBatch($seeds);
   }
}
