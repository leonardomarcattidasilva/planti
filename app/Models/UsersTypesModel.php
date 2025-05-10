<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersTypesModel extends Model
{
   protected $table = 'users_types';
   protected $allowedFields = ['id_type', 'id_user'];
   protected $primaryKey = 'id_type';
   protected $useTimestamps = false;
}
