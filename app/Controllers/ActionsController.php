<?php

namespace App\Controllers;

use App\Models\PlantasModel;
use App\Models\AcoesModel;
use App\Models\TiposModel;
use App\Models\UsersTypesModel;

class ActionsController extends BaseController
{
   private object $model;
   private ?array $data;

   private function checkView(string $file)
   {
      if (!is_file(APPPATH . 'Views/' . $file . '.php')) {
         throw new \CodeIgniter\Exceptions\PageNotFoundException($file);
      };
   }

   public function cadastrar()
   {
      $this->model = model(PlantasModel::class);
      $this->data['tab'] = 'Planti - Sucesso';
      $this->data['title'] = 'Sucesso!';

      $this->checkView('Success');
      $post = $this->request->getPost(['planta', 'tipo']);

      if (!empty($post) && $this->validateData($post, ['planta' => 'required', 'tipo' => 'required'], ['planta' => ['required' => 'O campo é obrigatório'], 'tipo' => ['required' => 'O campo é obrigatório']]) && $post['tipo'] != 0) {
         $this->model->addPlanta(\strval($this->request->getPost('planta')), intval($this->request->getPost('tipo')), \session()->get('id'));
         return redirect()->to('/success');
      };

      return \redirect()->route('cadastroPlanta')->with('errors', \session()->setTempdata('err', $this->validator->getErrors(), 10));
   }

   public function cadastrarTipo()
   {

      $this->checkView('Success');
      $this->model = model(TiposModel::class);
      $post = $this->request->getPost(['type']);

      if (!empty($post) && $this->validateData($post, ['type' => 'required|min_length[3]'], ['type' => ['required' => 'O campo é obrigatório!', 'min_length' => 'Digite pelo menos 3 caracteres']])) {
         $result = $this->model->insert(['type' => $this->request->getPost('type')], true);
         if ($result) {
            $sessionID = \session()->get('id');
            $this->model = model(UsersTypesModel::class);
            $this->model->insert(['id_user' => $sessionID, 'id_type' => $result]);
         }
         return redirect()->to('/successTipo');
      };

      return \redirect()->route('type')->with('errors', \session()->setTempdata('err', $this->validator->getErrors(), 10));
   }

   public function updatePlanta()
   {
      $this->model = model(PlantasModel::class);

      if ($this->request->getMethod() == 'post' && $this->validate(['id' => 'required', 'nome' => 'required'])) {
         $this->model->updatePlanta(intval($this->request->getPost('id')), strval($this->request->getPost('nome')));
      };

      return redirect()->route('home');
   }

   public function confirmaDeletar()
   {
      if ($this->request->getMethod() == 'post' && $this->validate(['id' => 'required'])) {
         $this->model = \model(AcoesModel::class);
         $this->model->deletaAcoesPlanta(intval($this->request->getPost('id')));
         $this->model = \model(PlantasModel::class);
         $this->model->deletaPlanta(intval($this->request->getPost('id')));
      };

      return redirect()->route('home');
   }

   public function cadastrarCuidado()
   {
      \helper('form');

      $this->checkView('SuccessAction');

      $post = $this->request->getPost(['acao', 'id']);
      $validData = $this->validateData($post, ['id' => 'required', 'acao' => 'required'], ['acao' => ['required' => 'O campo é obrigatório']]);
      if ($this->request->getMethod() == 'post' && $validData) {
         $this->model = model(AcoesModel::class);
         $this->model->adicionarAcao(intval($post['id']), strval($post['acao']));
         return redirect()->to("/successAction?id=" . $post['id']);
      }
      return \redirect()->route('addCuidados')->with('errors', \session()->set('err', $this->validator->getErrors()));
   }

   public function cuidadosTipo()
   {

      $post = $this->request->getPost(['tipo', 'acao']);

      if ($this->request->getMethod() == 'post' && $this->validateData($post, ['tipo' => 'required', 'acao' => 'required'])) {
         $this->model = model(PlantasModel::class);
         $tipo = strval($this->request->getPost('tipo'));
         $list = $this->model->getPlantasByTipo($tipo);

         $acao = strval($this->request->getPost('acao'));
         $this->model = model(AcoesModel::class);

         foreach ($list as $key => $value) {
            $this->model->addCuidadoTipo($value['id'], $acao);
         };

         return redirect()->route('successTipo');
      };
   }

   public function updateCuidado()
   {
      $this->model = \model(AcoesModel::class);
      $edit = $this->request->getPost(['id', 'id_plant', 'action', 'start_date', 'deadline']);
      if ($this->request->getMethod() == 'POST' && $this->validateData($edit, ['id' => 'required', 'action' => 'required'])) {
         $this->model->updateCuidado(intval($edit['id']), strval($edit['action']), $edit['start_date'], $edit['deadline']);
      };

      return redirect()->to('/detalhes?id=' . $this->request->getPost('id_plant'));
   }

   public function cuidadosTodas()
   {

      $post = $this->request->getPost(['acao']);

      $this->model = \model(PlantasModel::class);
      if (!empty($post)  && $this->validateData($post, ['acao' => 'required'])) {
         $todasPlantas = $this->model->getTodasID(\session()->get('id'));
         $this->model = model(AcoesModel::class);
         foreach ($todasPlantas as $key => $value) {
            $this->model->adicionarAcao($value['id'], strval($this->request->getPost('acao')));
         };
         return redirect()->route('home');
      };
   }
}
