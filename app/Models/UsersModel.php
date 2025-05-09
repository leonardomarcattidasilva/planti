<?php

namespace App\Models;

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
         $this->insert(['nome' => $name, 'password' => $password, 'email' => $email]);
         return true;
      }

      return false;
   }
}
