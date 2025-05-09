<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Types extends Migration
{
   public function up()
   {
      $this->forge->addField([
         'id' => ['type' => 'int', 'unsigned' => true, 'auto_increment' => true],
         'type' => ['type' => 'varchar', 'constraint' => 50]
      ]);

      $this->forge->addKey('id', true);
      $this->forge->createTable('types');
   }

   public function down()
   {
      $this->forge->dropTable('types');
   }
}
