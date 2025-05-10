<?php

namespace App\Models;

use CodeIgniter\Model;

class AcoesModel extends Model
{
   protected $table = 'actions';
   protected $allowedFields = ['action', 'id_plant', 'start_date', 'deadline'];

   public function getCuidados(int $id)
   {
      return $this->Where('id_plant', $id)->limit(3)->orderBy('id', 'desc')->get()->getResultArray();
   }

   public function getDetalhes(int $id, int $page)
   {
      $p = ($page === 0) ? 0 : ($page - 1) * 4;
      return $this->Where('id_plant', $id)->orderBy('id', 'desc')->limit(4, $p)->get()->getResultArray();
   }

   public function deletaAcoesPlanta(int $id_plant)
   {
      $this->where('id_plant', $id_plant)->delete();
   }

   public function adicionarAcao(int $id, string $acao)
   {
      $this->insert(['acao' => $acao, 'id_plant' => $id]);
   }

   public function addCuidadoTipo(int $id, string $acao)
   {
      $this->insert(['acao' => $acao, 'id_plant' => $id]);
   }

   public function getCuidado(int $id)
   {
      return $this->where('id', $id)->get()->getRowArray();
   }

   public function updateCuidado(int $id, string $nome)
   {
      $this->set('acao', $nome)->where('id', $id)->update();
   }

   public function deleteCuidado(int $id)
   {
      $this->where('id', $id)->delete();
   }
}
