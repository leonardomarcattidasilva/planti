<?php

namespace App\Controllers;

use App\Models\PlantasModel;
use App\Models\AcoesModel;
use App\Models\TiposModel;
use App\Models\UsersTypesModel;
use CodeIgniter\I18n\Time;

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

   public function cadastrarTipo()
   {
      $this->checkView('successTipo');
      $this->model = model(TiposModel::class);
      $post = $this->request->getPost([\trim('type')]);

      $rules = [
         'type' => [
            'rules' => 'required|min_length[3]',
            'errors' => ['required' => 'O campo é obrigatório!', 'min_length' => 'Digite pelo menos 3 caracteres']
         ]
      ];

      $validData = $this->validateData($post, $rules);

      if (!empty($post) && $validData) {
         $sessionID = \session()->get('id');
         $checkedType = $this->checkType($post['type']);

         if (!$checkedType) {
            $insert = $this->model->insert(['type' => $post['type'], 'created_at' => Time::now()], true);
            $this->model = model(UsersTypesModel::class);
            $this->model->insert(['id_user' => $sessionID, 'id_type' => $insert]);
         }

         if ($checkedType) {
            $this->model = model(UsersTypesModel::class);
            $this->model->insert(['id_user' => $sessionID, 'id_type' => $checkedType['id']]);
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

      $post = $this->request->getPost(['type', 'action', 'title', 'start_date', 'deadline']);
      $valid_data = $this->validateData($post, ['type' => 'required', 'action' => 'required', 'title' => 'required', 'start_date' => 'required', 'deadline' => 'required']);
      if ($this->request->getMethod() == 'POST' && $valid_data) {
         $this->model = model(PlantasModel::class);
         $type = strval($this->request->getPost('type'));
         $plants_list = $this->model->getPlantasByTipo($type);
         $action = strval($this->request->getPost('action'));
         $title = strval($this->request->getPost('title'));
         $start_date = strval($this->request->getPost('start_date'));
         $deadline = strval($this->request->getPost('deadline'));
         $this->model = model(AcoesModel::class);

         foreach ($plants_list as $key => $value) {
            $this->model->addCuidadoTipo($value['id'], $title, $action, $start_date, $deadline);
         };

         return redirect()->route('successTipo');
      };

      return \redirect()->back();
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

      return view('Views/editCuidado', $this->data);
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
