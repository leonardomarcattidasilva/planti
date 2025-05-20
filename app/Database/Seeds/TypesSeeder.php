<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
class TypesSeeder extends Seeder
{
   public function run()
   {
      $seeds = [
         ['type' => 'Type A', 'created_at' => Time::now()],
         ['type' => 'Type B', 'created_at' => Time::now()],
         ['type' => 'Type C', 'created_at' => Time::now()],
         ['type' => 'Type D', 'created_at' => Time::now()],
         ['type' => 'Type E', 'created_at' => Time::now()],
      ];

      $this->db->table('types')->insertBatch($seeds);
   }
}
