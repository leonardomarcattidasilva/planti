<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlantsSeeder extends Seeder
{
   public function run()
   {
      $plants = [
         ['name' => 'Planta 1', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 3', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 3', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 4', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 5', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 6', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 7', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 8', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 9', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],
         ['name' => 'Planta 10', 'id_type' => rand(1, 4), 'id_user' => rand(1, 3)],

      ];

      $this->db->table('plants')->insertBatch($plants);
   }
}
