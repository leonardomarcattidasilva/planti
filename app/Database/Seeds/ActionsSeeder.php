<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ActionsSeeder extends Seeder
{
   public function run()
   {
      $actons = [
         ['action' => 'Ação A', 'id_plant' => rand(1, 10), 'start_date' => '2025-04-12', 'deadline' => '2025-05-02'],
         ['action' => 'Ação B', 'id_plant' => rand(1, 10), 'start_date' => '2025-03-08', 'deadline' => '2025-04-20'],
         ['action' => 'Ação C', 'id_plant' => rand(1, 10), 'start_date' => '2025-05-01', 'deadline' => '2025-06-15'],
         ['action' => 'Ação D', 'id_plant' => rand(1, 10), 'start_date' => '2025-02-19', 'deadline' => '2025-03-10'],
         ['action' => 'Ação E', 'id_plant' => rand(1, 10), 'start_date' => '2025-04-05', 'deadline' => '2025-04-25'],
      ];

      $this->db->table('actions')->insertBatch($actons);
   }
}
