<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypesSeeder extends Seeder
{
   public function run()
   {
      $seeds = [
         ['type' => 'Type A'],
         ['type' => 'Type B'],
         ['type' => 'Type C'],
         ['type' => 'Type D'],
         ['type' => 'Type E'],
      ];

      $this->db->table('types')->insertBatch($seeds);
   }
}
