<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class UsersModel extends Model
{

   protected $table = 'users';
   protected $allowedFields = ['nome', 'password', 'email'];
   protected $primaryKey = 'id';

   public function getUser($email, $password)
   {
      $user = $this->select(['id', 'name'])->where('email', $email)->where('password', $password)->get()->getRow();
      return ($user) ? $user : false;
   }

   private function checkEmail(string $email): bool
   {
      $result = $this->select(['id'])->where('email', $email)->get()->getRowArray();
      if (isset($result['id'])) {
         return false;
      }

      return true;
   }

   public function addUser(string $name, string $email, string $password): bool
   {
      $checkedEmail = $this->checkEmail($email);
      if ($checkedEmail) {
         $this->insert(['name' => $name, 'password' => $password, 'email' => $email, 'created_at' => Time::now()]);
         return true;
      }

      return false;
   }
}
