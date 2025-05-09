<?php

namespace App\Models;

use CodeIgniter\Model;

class TiposModel extends Model
{
   protected $table = 'types';
   protected $allowedFields = ['type', 'id_user'];
   protected $primaryKey = 'id';

   public function getTipos(int $id)
   {
      $todas = $this->select(['id', 'type'])
         ->get()
         ->getResultArray();
      return $todas;
   }
}
