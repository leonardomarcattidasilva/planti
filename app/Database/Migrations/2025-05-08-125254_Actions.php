<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Actions extends Migration
{
   public function up()
   {
      $this->forge->addField([
         'id' => ['type' => 'int', 'unsigned' => true, 'auto_increment' => true],
         'title' => ['type' => 'varchar', 'constraint' => 50],
         'action' => ['type' => 'text'],
         'id_plant' => ['type' => 'int', 'unsigned' => true],
         'start_date' => ['type' => 'date'],
         'deadline' => ['type' => 'date'],
         'done' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
         'created_at' => ['type' => 'datetime', 'null' => true],
         'updated_at' => ['type' => 'datetime', 'null' => true],
      ]);

      $this->forge->addKey('id', true);
      $this->forge->addForeignKey('id_plant', 'plants', 'id', 'CASCADE', 'CASCADE');
      $this->forge->createTable('actions');
   }

   public function down()
   {
      $this->forge->dropTable('actions');
   }
}
