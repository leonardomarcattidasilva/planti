<?php

namespace App\Models;

use CodeIgniter\Model;

class PlantasModel extends Model
{
   protected $table = 'plants';
   protected $allowedFields = ['name', 'id_type', 'id_user'];
   protected $primaryKey = 'id';

   public function getUserPlantas(int $id): array
   {
      return $this->orderBy('name', 'ASC')->where('id_user', $id)->findAll();
   }

   public function getPlantas(string $id = '0')
   {
      if ($id == 0) {
         return $this->orderBy('name', 'ASC')->findAll();
      };

      return $this->where('id', $id)->first();
   }

   public function getPlantasByTipo(int $type)
   {
      return $this->select('id')->where('id_type', $type)->findAll();
   }

   public function addPlanta(string $name, int $type, int $id)
   {
      return $this->insert(['name' => $name, 'id_type' => $type, 'id_user' => $id]);
   }

   public function deletaPlanta(int $id)
   {
      $this->delete(['id' => $id]);
   }

   public function updatePlanta(int $id, string $name)
   {
      $this->where('id', $id)->set(['name' => $name])->update();
   }

   public function getTodasID(int $id)
   {
      $todas = $this->select('id')->where('id_user', $id)->get()->getResultArray();
      return $todas;
   }
}
