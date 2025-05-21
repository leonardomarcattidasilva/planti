<?php

namespace App\Models;

use CodeIgniter\Model;

class TiposModel extends Model
{
   protected $table = 'types';
   protected $allowedFields = ['type', 'created_at', 'updated_at'];
   protected $primaryKey = 'id';

   public function getTipos(int $id)
   {
      $todas = $this->db->table('types t')->select(['t.id', 't.type'])->join('users_types ut', 'id = ut.id_type')->where('ut.id_user', $id)
         ->get()
         ->getResultArray();
      return $todas;
   }
}
