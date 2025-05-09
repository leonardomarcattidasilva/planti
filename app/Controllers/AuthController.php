<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AuthController extends BaseController
{
   private object $model;

   private function encriptData(string $data): string
   {
      return \base64_encode($data);
   }

   public function logupAction()
   {
      \helper('form');

      $post = $this->request->getPost(['name', 'email', 'password', 'password2']);
      $rules = [
         [
            'name' => 'required|min_length[3]',
            'email' => 'required|max_length[254]|valid_email',
            'password' => 'required|min_length[6]',
            'password2' => 'required|matches[password]'
         ],
         [
            'name' => ['required' => 'O campo é obrigatório', 'nim_length' => 'O campo deve ter pelo menos 3 caracteres'],
            'email' => ['required' => 'O campo é obrigatório', 'valid_email' => 'O campo deve ser um email válido'],
            'password' => ['required' => 'O campo é obrigatório', 'min_length' => 'O campo deve ter pelo menos 6 caracteres'],
            'password2' => ['required' => 'O campo é obrigatório', 'matches' => 'As senhas não combinam']
         ]
      ];

      $validData = $this->validateData($post, $rules);
      if ($this->request->getMethod() == 'post' && $validData) {
         $this->model = new UsersModel();
         $result = $this->model->addUser($this->encriptData($post['name']), $this->encriptData($post['email']), $this->encriptData($post['password']));

         if ($result) {
            return redirect()->to("login");
         }

         return \redirect()->route('logup')->withInput()->with('bad_email', 'Email em uso');
      }

      return \redirect()->route('logup')->withInput()->with('errors', \session()->setTempdata('err', $this->validator->getErrors(), 10));
   }

   public function loginAction()
   {
      helper('form');
      $post = $this->request->getPost(['email', 'password']);

      $rules = [
         'email'    => [
            'rules' => 'required|valid_email',
            'errors' => ['required' => 'O campo é obrigatório', 'valid_email' => 'Insira um email válido'],

         ],
         'password' => [
            'rules' => 'required|min_length[6]',
            'errors' => ['required' => 'O campo é obrigatório', 'min_length' => 'O campo deve ter pelo menos 6 caracteres'],
         ]
      ];

      $validData = $this->validateData($post, $rules);
      if ($this->request->getMethod() === 'POST' && $validData) {
         $this->model = new UsersModel();
         $foundUser = $this->model->getUser($this->encriptData($post['email']), $this->encriptData($post['password']));
         if ($foundUser) {
            \session()->set(['id' => $foundUser->id, 'nome' => \base64_decode($foundUser->name)]);
            return \redirect()->route('home');
         }

         return \redirect()->route('login')->withInput()->with('bad_email', 'Usuário e/ou senha não cadastrados');
      }

      dd('erro');

      return \redirect()->route('login')->withInput()->with('errors', \session()->setTempdata('err', $this->validator->getErrors(), 10));
   }

   public function logout()
   {
      \session()->destroy();
      return \redirect()->route('login');
   }
}
