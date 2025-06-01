<?php

namespace App\Controllers;

use App\Models\PlantasModel;
use App\Models\AcoesModel;
use App\Models\TiposModel;

class PagesController extends BaseController
{
   private ?array $data;
   private object $model;

   private function checkView(string $file)
   {
      if (!is_file(APPPATH . 'Views/' . $file . '.php')) {
         throw new \CodeIgniter\Exceptions\PageNotFoundException($file);
      };
   }

   public function login()
   {
      $this->checkView('login');
      helper('form');
      $this->data['tab'] = 'Login';
      return view('Views/login', $this->data);
   }

   public function logup()
   {
      $this->checkView('logup');

      helper('form');
      $this->data['tab'] = 'Logup';
      return view('Views/logup', $this->data);
   }

   public function home()
   {
      $this->checkView('home');

      if (\session()->has('id')) {
         $this->model = model(AcoesModel::class);
         $this->data['alerts'] = $this->model->getAlerts(session()->get('id'));
         $this->data['tab'] = 'Planti - Home';
         $this->model = model(PlantasModel::class);
         $this->data['plantas'] = $this->model->getUserPlantas(session()->get('id'));

         return view('Views/home', $this->data);
      }

      return \redirect()->route('login');
   }

   public function cadastroPlanta()
   {
      helper('form');

      $this->checkView('cadastroPlanta');
      $this->data['tab'] = 'Planti - Cadastro';
      $this->data['title'] = 'Cadastro de Plantas';
      $this->model = model(TiposModel::class);
      $this->data['tipos'] = $this->model->getTipos(session()->get('id'));

      return view('Views/cadastroPlanta', $this->data);
   }

   public function cadastroTipos()
   {
      $this->checkView('cadastroTipos');

      helper('form');
      $this->data['tab'] = 'Planti - Cadastro';
      $this->data['title'] = 'Cadastro de Tipos';

      return view('Views/cadastroTipos', $this->data);
   }

   public function verPlanta()
   {
      $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
      $r = \filter_input(\INPUT_GET, 'r', \FILTER_SANITIZE_NUMBER_INT);

      if ($id != 0) {
         $this->data['tab'] = 'Planti - Planta';
         $this->model = \model(PlantasModel::class);
         $this->data['planta'] = $this->model->getPlantas($id);
         $this->data['cuidados'] = $this->getAcoes(\intval($id));
         $r ? $this->data['mensagem'] = 'Não há detalhes' : '';

         if (empty($this->data['planta'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Planta não encontrada!');
         };

         $this->checkView('planta');

         return view('Views/planta', $this->data);
      } else {
         return redirect()->route('home');
      };
   }

   public function getAcoes(string $id)
   {
      $this->model = \model(AcoesModel::class);
      return $this->model->getCuidados($id);
   }

   public function detalhes()
   {
      $this->model = \model(AcoesModel::class);
      $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
      $page = (\filter_input(\INPUT_GET, 'page', \FILTER_SANITIZE_NUMBER_INT)) ? \filter_input(\INPUT_GET, 'page', \FILTER_SANITIZE_NUMBER_INT) : 0;

      $this->data['number'] = $this->model->where('id_plant', $id)->paginate(4);
      $this->data['pager'] = $this->model->pager;
      $this->data['detalhes'] = $this->model->getDetalhes($id, $page);
      $this->data['title'] = 'Detalhes da Planta';
      $this->data['tab'] = 'Planti - Detalhes';
      $this->data['id_plant'] = $id;
      $this->model = \model(PlantasModel::class);
      $this->data['planta'] = $this->model->getPlantas($id);

      if (empty($this->data['detalhes'])) {
         return redirect()->to('planta?id=' . $id . '&r=1');
      };

      $this->checkView('detalhes');

      return view('Views/detalhes', $this->data);
   }

   public function deletar()
   {
      $this->data['title'] = 'Deletar Planta';
      $this->data['tab'] = 'Planti - Deletar';
      $this->data['mensagem'] = 'Deseja mesmo deletar a planta?';
      $this->data['id'] = $_GET['id'];

      $this->checkView('deletar');

      return view('Views/deletar', $this->data);
   }

   public function getPlanta()
   {
      $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
      $this->model = model(PlantasModel::class);
      $this->data['planta'] = $this->model->getPlantas($id);
      $this->data['id'] = $id;
      $this->data['title'] = 'Editar Planta';
      $this->data['tab'] = 'Planti - Editar';

      if (empty($this->data['planta'])) {
         throw new \CodeIgniter\Exceptions\PageNotFoundException('Planta não encontrada!');
      };

      $this->checkView('editarPlanta');

      return view('Views/editarPlanta', $this->data);
   }

   public function adicionarCuidados()
   {
      $this->checkView('adicionaCuidado');

      helper('form');
      $id =  \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
      $this->data['title'] = 'Adicionar Cuidado';
      $this->data['tab'] = 'Planti - Cuidados';
      $this->data['id'] = $id;

      return view('Views/adicionaCuidado', $this->data);
   }

   public function cuidadosTodas()
   {
      $this->data['tab'] = 'Planti - Cuidados';
      $this->data['title'] = 'Adicionar cuidados a todas as plantas cadastradas';

      $this->checkView('cuidados');

      return view('Views/cuidados', $this->data);
   }

   public function cuidadosTipos()
   {
      $this->data['tab'] = 'Planti - Tipos';
      $this->data['title'] = 'Adicionar cuidados as plantas por tipo';
      $this->model = model(TiposModel::class);
      $this->data['types'] = $this->model->getTipos(session()->get('id'));
      $this->checkView('cuidadosTipos');

      return view('Views/cuidadosTipos', $this->data);
   }

   public function success()
   {
      $this->data['tab'] = 'Planti - Sucesso';
      $this->data['title'] = 'Sucesso';

      $this->checkView('success');

      return view('Views/success', $this->data);
   }

   public function successTipo()
   {
      $this->data['tab'] = 'Planti - Sucesso';
      $this->data['title'] = 'Sucesso';

      $this->checkView('successTipo');

      return view('Views/successTipo', $this->data);
   }

   public function successAction()
   {
      $this->data['tab'] = 'Planti - Sucesso';
      $this->data['title'] = 'Sucesso';

      $this->checkView('successAction');

      return view('Views/successAction', $this->data);
   }
}
