<?php

namespace App\Models;

use CodeIgniter\Model;

class PlantasModel extends Model
{
   protected $table = 'plants';
   protected $allowedFields = ['name', 'type', 'id_user'];
   protected $primaryKey = 'id';

   public function getUserPlantas(int $id): array
   {
      return $this->orderBy('name', 'ASC')->where('id_user', $id)->findAll();
   }

   public function getPlantas(int $id = 0)
   {
      if ($id == 0) {
         return $this->orderBy('name', 'ASC')->findAll();
      };

      return $this->where('id', $id)->first();
   }

   public function getPlantasByTipo(int $tipo)
   {
      return $this->select('id')->where('tipo', $tipo)->findAll();
   }

   public function addPlanta(string $name, int $tipo, int $id)
   {
      return $this->insert(['name' => $name, 'tipo' => $tipo, 'id_user' => $id]);
   }

   public function deletaPlanta(int $id)
   {
      $this->delete(['id' => $id]);
   }

   public function updatePlanta(int $id, string $name)
   {
      $this->set('name', $name)->where('id', $id)->update();
   }

   public function getTodasID(int $id)
   {
      $todas = $this->select('id')->where('id_user', $id)->get()->getResultArray();
      return $todas;
   }
}
