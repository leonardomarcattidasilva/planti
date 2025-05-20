<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ActionsSeeder extends Seeder
{
   public function run()
   {
      $actons = [
         ['title' => 'Ação A', 'action' => 'Foi feita a ação A', 'id_plant' => rand(1, 10), 'start_date' => '2025-04-12', 'deadline' => '2025-05-02', 'done' => \rand(0, 1), 'created_at' => Time::now()],
         ['title' => 'Ação B', 'action' => 'Foi feita a ação B', 'id_plant' => rand(1, 10), 'start_date' => '2025-03-08', 'deadline' => '2025-04-20', 'done' => \rand(0, 1), 'created_at' => Time::now()],
         ['title' => 'Ação C', 'action' => 'Foi feita a ação C', 'id_plant' => rand(1, 10), 'start_date' => '2025-05-01', 'deadline' => '2025-06-15', 'done' => \rand(0, 1), 'created_at' => Time::now()],
         ['title' => 'Ação D', 'action' => 'Foi feita a ação D', 'id_plant' => rand(1, 10), 'start_date' => '2025-02-19', 'deadline' => '2025-03-10', 'done' => \rand(0, 1), 'created_at' => Time::now()],
         ['title' => 'Ação E', 'action' => 'Foi feita a ação E', 'id_plant' => rand(1, 10), 'start_date' => '2025-04-05', 'deadline' => '2025-04-25', 'done' => \rand(0, 1), 'created_at' => Time::now()],
      ];

      $this->db->table('actions')->insertBatch($actons);
   }
}
