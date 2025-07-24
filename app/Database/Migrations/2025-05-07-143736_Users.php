<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
   public function up()
   {
      $this->forge->addField([
         'id' => ['type' => 'int', 'unsigned' => true, 'auto_increment' => true],
         'name' => ['type' => 'varchar', 'constraint' => 50],
         'email' => ['type' => 'varchar', 'constraint' => 50],
         'password' => ['type' => 'varchar', 'constraint' => 50],
         'created_at' => ['type' => 'datetime', 'null' => true],
         'updated_at' => ['type' => 'datetime', 'null' => true],
      ]);
      $this->forge->addKey('id', true);
      $this->forge->addUniqueKey('email');
      $this->forge->createTable('users');
   }

   public function down()
   {
      $this->forge->dropTable('users');
   }
}
