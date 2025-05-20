<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PlantsSeeder extends Seeder
{
   public function run()
   {
      $plants = [
         ['name' => 'Planta 1', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 2', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 3', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 4', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 5', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 6', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 7', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 8', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 9', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
         ['name' => 'Planta 10', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3), 'created_at' => Time::now()],
      ];

      $this->db->table('plants')->insertBatch($plants);
   }
}
