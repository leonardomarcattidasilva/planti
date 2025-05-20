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

   public function done()
   {
      $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
      $this->model = model(AcoesModel::class);
      $this->model->done($id);
      return redirect()->back();
   }

   public function getAlerts()
   {
      $this->model = model(AcoesModel::class);
   }

   public function deletarCuidado()
   {
      $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
      $idplanta = \filter_input(\INPUT_GET, 'id_plant', \FILTER_SANITIZE_NUMBER_INT);
      $this->model = \model(AcoesModel::class);
      $this->model->deleteCuidado($id);
      return redirect()->to('/planta?id=' . $idplanta);
   }

   public function cadastrar()
   {
      $this->model = model(PlantasModel::class);
      $this->data['tab'] = 'Planti - Sucesso';
      $this->data['title'] = 'Sucesso!';

      $this->checkView('success');
      $post = $this->request->getPost(['name', 'type']);
      if (!empty($post) && $this->validateData($post, ['name' => 'required', 'type' => 'required'], ['name' => ['required' => 'O campo é obrigatório'], 'type' => ['required' => 'O campo é obrigatório']])) {
         $this->model->addPlanta($post['name'], $post['type'], \session()->get('id'));
         return redirect()->to('/success');
      };

      return \redirect()->route('cadastroPlanta')->with('errors', \session()->setTempdata('err', $this->validator->getErrors(), 10));
   }

   private function checkType(string $type)
   {
      $this->model = model(TiposModel::class);
      $type = $this->model->select('id')->where('type', $type)->get()->getRowArray();
      return $type;
   }

   /**
    **todo = verificar se tipo user já existe
    */

   public function cadastrarTipo()
   {
      $this->checkView('successTipo');
      $this->model = model(TiposModel::class);
      $post = $this->request->getPost([\trim('type')]);
      if (!empty($post) && $this->validateData($post, ['type' => 'required|min_length[3]'], ['type' => ['required' => 'O campo é obrigatório!', 'min_length' => 'Digite pelo menos 3 caracteres']])) {
         $sessionID = \session()->get('id');
         $checkedType = $this->checkType($post['type']);
         $this->model = model(UsersTypesModel::class);

         if ($checkedType['id']) {
            $this->model->insert(['id_user' => $sessionID, 'id_type' => $checkedType['id']]);
         }

         if (!$checkedType['id']) {
            $insert = $this->model->insert(['type' => $post['type']], true);
            $this->model->insert(['id_user' => $sessionID, 'id_type' => $insert['id']]);
         }

         return redirect()->to('/successTipo');
      };
      return \redirect()->route('tipo')->with('errors', \session()->setTempdata('err', $this->validator->getErrors(), 10));
   }

   public function updatePlanta()
   {
      $this->model = model(PlantasModel::class);
      $post = $this->request->getPost(['name', 'id']);
      if ($this->request->getMethod() == 'POST' && $this->validateData($post, ['id' => 'required', 'name' => 'required'])) {
         $this->model->updatePlanta(intval($post['id']), $post['name']);
      };

      return redirect()->route('home');
   }

   public function confirmaDeletar()
   {
      $id = $this->request->getPost(['id']);
      if ($this->request->getMethod() == 'POST' && $this->validateData($id, ['id' => 'required'])) {
         $this->model = \model(PlantasModel::class);
         $this->model->deletaPlanta(intval($this->request->getPost('id')));
      };

      return redirect()->route('home');
   }

   public function cadastrarCuidado()
   {
      \helper('form');
      $this->checkView('successAction');

      $post = $this->request->getPost(['action', 'id_plant', 'start_date', 'deadline', 'title', 'id_plant']);
      $validData = $this->validateData($post, ['id_plant' => 'required', 'action' => 'required'], ['action' => ['required' => 'O campo é obrigatório']]);
      if ($this->request->getMethod() == 'POST' && $validData) {
         $this->model = model(AcoesModel::class);
         $this->model->adicionarAcao(intval($post['id_plant']), strval($post['action']), $post['start_date'], $post['deadline'], $post['title'],);
         return redirect()->to("/successAction?id=" . $post['id_plant']);
      }
      return \redirect()->to('adicionarCuidados?id=' . $post['id_plant'])->with('errors', \session()->set('err', $this->validator->getErrors()));
   }

   public function cuidadosTipo()
   {

      $post = $this->request->getPost(['tipo', 'action']);

      if ($this->request->getMethod() == 'post' && $this->validateData($post, ['tipo' => 'required', 'action' => 'required'])) {
         $this->model = model(PlantasModel::class);
         $tipo = strval($this->request->getPost('tipo'));
         $list = $this->model->getPlantasByTipo($tipo);

         $action = strval($this->request->getPost('action'));
         $this->model = model(AcoesModel::class);

         foreach ($list as $key => $value) {
            $this->model->addCuidadoTipo($value['id'], $action);
         };

         return redirect()->route('successTipo');
      };
   }

   public function updateCuidado()
   {
      $this->model = \model(AcoesModel::class);
      $edit = $this->request->getPost(['id', 'id_plant', 'action', 'start_date', 'deadline', 'title']);
      if ($this->request->getMethod() == 'POST' && $this->validateData($edit, ['id' => 'required', 'action' => 'required'])) {
         $this->model->updateCuidado(intval($edit['id']), strval($edit['action']), $edit['start_date'], $edit['deadline'], $edit['title']);
      };

      return redirect()->to('/detalhes?id=' . $this->request->getPost('id_plant'));
   }

   public function editarCuidado()
   {
      $id = filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
      $this->model = \model(AcoesModel::class);
      $this->data['cuidado'] = $this->model->getCuidado(\intval($id));
      $this->data['title'] = 'Editar Cuidado';
      $this->data['tab'] = 'Planti - Cuidados';

      $this->checkView('editCuidado');

      return view('Views/templates/header', $this->data) . view('Views/editCuidado') . view('Views/templates/footer');
   }

   public function cuidadosTodas()
   {

      $post = $this->request->getPost(['action']);

      $this->model = \model(PlantasModel::class);
      if (!empty($post)  && $this->validateData($post, ['action' => 'required'])) {
         $todasPlantas = $this->model->getTodasID(\session()->get('id'));
         $this->model = model(AcoesModel::class);
         foreach ($todasPlantas as $key => $value) {
            $this->model->adicionarAcao($value['id'], strval($this->request->getPost('action')));
         };
         return redirect()->route('home');
      };
   }
}
