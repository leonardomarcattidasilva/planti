<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Plants extends Migration
{
   public function up()
   {
      $this->forge->addField([
         'id' => ['type' => 'int', 'unsigned' => true, 'auto_increment' => true],
         'name' => ['type' => 'varchar', 'constraint' => 50],
         'id_type' => ['type' => 'int', 'unsigned' => true],
         'id_user' => ['type' => 'int', 'unsigned' => true],
         'created_at' => ['type' => 'datetime', 'null' => true],
         'updated_at' => ['type' => 'datetime', 'null' => true],
      ]);

      $this->forge->addKey('id', true);
      $this->forge->addUniqueKey('name');
      $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
      $this->forge->addForeignKey('id_type', 'types', 'id', 'CASCADE', 'CASCADE');
      $this->forge->createTable('plants');
   }

   public function down()
   {
      $this->forge->dropTable('plants');
   }
}
