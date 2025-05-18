<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class AcoesModel extends Model
{
   protected $table = 'actions';
   protected $allowedFields = ['action', 'id_plant', 'start_date', 'deadline', 'done', 'title'];

   public function getAlerts(string $id)
   {
      $builder = $this->db->table('actions a');
      $builder->select('*');
      $builder->where('a.done', 0);
      $builder->where('deadline <=', Time::today()->toDateString());
      $builder->whereIn('a.id_plant', function ($subQuery) use ($id) {
         return $subQuery->select('id')
            ->from('plants')
            ->where('id_user', $id);
      });
      $query = $builder->get();
      return $query->getResult();
   }

   public function done(int $id)
   {

      return $this->update($id, ['done' => 1]);
   }

   public function getCuidados(int $id)
   {
      return $this->Where('id_plant', $id)->limit(3)->orderBy('deadline', 'asc')->get()->getResultArray();
   }

   public function getDetalhes(string $id, string $page)
   {
      $p = ($page == 0) ? 0 : ($page - 1) * 4;
      return $this->Where('id_plant', $id)->orderBy('deadline', 'asc')->limit(4, $p)->get()->getResultArray();
   }

   public function deletaAcoesPlanta(int $id_plant)
   {
      $this->where('id_plant', $id_plant)->delete();
   }

   public function adicionarAcao(int $id, string $action, string $start_date, string $deadline, string $title)
   {
      $this->insert(['action' => $action, 'id_plant' => $id, 'start_date' => $start_date, 'deadline' => $deadline, 'title' => $title]);
   }

   public function addCuidadoTipo(int $id, string $action)
   {
      $this->insert(['action' => $action, 'id_plant' => $id]);
   }

   public function getCuidado(int $id)
   {
      return $this->where('id', $id)->get()->getRowArray();
   }

   public function updateCuidado(int $id, string $action, string $start_date, string $deadline, string $title)
   {
      $this->where('id', $id)->set(['action' => $action, 'start_date' => $start_date, 'deadline' => $deadline, 'title' => $title])->update();
   }

   public function deleteCuidado(int $id)
   {
      $this->where('id', $id)->delete();
   }
}
