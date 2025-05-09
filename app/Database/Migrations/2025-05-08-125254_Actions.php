<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Actions extends Migration
{
   public function up()
   {
      $this->forge->addField([
         'id' => ['type' => 'int', 'unsigned' => true, 'auto_increment' => true],
         'action' => ['type' => 'text'],
         'id_plant' => ['type' => 'int', 'unsigned' => true],
         'start_date' => ['type' => 'date'],
         'deadline' => ['type' => 'date'],
      ]);

      $this->forge->addKey('id');
      $this->forge->addForeignKey('id_plant', 'plants', 'id', 'CASCADE', 'CASCADE');
      $this->forge->createTable('actions');
   }

   public function down()
   {
      $this->forge->dropTable('actions');
   }
}
