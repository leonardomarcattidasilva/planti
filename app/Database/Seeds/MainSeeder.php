<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
   public function run()
   {
      $this->call('UsersSeeder');
      $this->call('TypesSeeder');
      $this->call('PlantsSeeder');
      $this->call('UsersTypesSeeder');
      $this->call('ActionsSeeder');
   }
}
