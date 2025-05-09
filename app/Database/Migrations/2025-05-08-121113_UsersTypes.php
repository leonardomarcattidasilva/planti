<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTypes extends Migration
{
   public function up()
   {
      $this->forge->addField([
         'id_user' => ['type' => 'int', 'unsigned' => \true],
         'id_type' => ['type' => 'int', 'unsigned' => \true]
      ]);

      $this->forge->addKey(['id_user', 'id_type'], \true);
      $this->forge->createTable('users_types');
   }

   public function down()
   {
      $this->forge->dropTable('users_types');
   }
}
