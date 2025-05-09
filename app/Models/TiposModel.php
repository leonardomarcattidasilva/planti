<?php
  namespace App\Models;

  use CodeIgniter\Model;

  class TiposModel extends Model {
    protected $table = 'tipo';
    protected $allowedFields = ['tipo', 'id_user'];
    protected $primaryKey = 'id';

    public function getTipos(int $id)
    {
      $todas = $this->select(['id', 'tipo'])->where('id_user', $id)->get()->getResultArray();
      return $todas;
    }

    
  }