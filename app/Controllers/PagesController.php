<?php

namespace App\Controllers;

use App\Models\PlantasModel;
use App\Models\AcoesModel;
use App\Models\TiposModel;

class PagesController extends BaseController
{
  private ?array $data;
  private object $model;

  public function login()
  {
    if (!is_file(APPPATH . 'Views/login.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('login');
    };

    helper('form');
    $this->data['tab'] = 'Login';
    return view('Views/templates/headerLogin.php', $this->data) . view('Views/login', $this->data) . view('Views/templates/footer.php');
  }

  public function logup()
  {
    if (!is_file(APPPATH . 'Views/logup.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('logup');
    };

    helper('form');
    $this->data['tab'] = 'Logup';
    return view('Views/templates/headerLogin.php', $this->data) . view('Views/logup', $this->data) . view('Views/templates/footer.php');
  }

  public function home()
  {
   
    if (!is_file(APPPATH . 'Views/home.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Home');
    };

    if (\session()->has('id')) {
      $this->data['tab'] = 'Planti - Home';
      $this->model = model(PlantasModel::class);
      $this->data['plantas'] = $this->model->getUserPlantas(session()->get('id'));

      return view('Views/templates/header.php', $this->data) . view('Views/home') . view('Views/templates/footer.php');
    }

    return \redirect()->route('login');
    
  }

  public function cadastroPlanta()
  {

    if (!is_file(APPPATH . 'Views/cadastroPlanta.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Cadastro Planta');
    };

    helper('form');
    $this->data['tab'] = 'Planti - Cadastro';
    $this->data['title'] = 'Cadastro de Plantas';
    $this->model = model(TiposModel::class);
    $this->data['tipos'] = $this->model->getTipos(session()->get('id'));

    return view('Views/templates/header.php', $this->data) . view('Views/cadastroPlanta') . view('Views/templates/footer.php');
  }

  public function cadastroTipos()
  {
    if (!is_file(APPPATH . 'Views/cadastroTipos.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Cadastro Tipos');
    }

    helper('form');
    $this->data['tab'] = 'Planti - Cadastro';
    $this->data['title'] = 'Cadastro de Tipos';

    return view('Views/templates/header.php', $this->data) . view('Views/cadastroTipos') . view('Views/templates/footer.php');
  }

  public function verPlanta()
  {
    $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
    $r = \filter_input(\INPUT_GET, 'r', \FILTER_SANITIZE_NUMBER_INT);
    if ($id != 0) {
      $this->data['tab'] = 'Planti - Planta';
      $this->model = \model(PlantasModel::class);
      $this->data['planta'] = $this->model->getPlantas($id);
      $this->data['cuidados'] = $this->getAcoes($id);
      $r ? $this->data['mensagem'] = 'Não há detalhes' : '' ;

      if (empty($this->data['planta'])) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Planta não encontrada!');
      };

      if (!is_file(APPPATH . 'Views/planta.php')) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Planta');
      };

      return view('Views/templates/header', $this->data). view('Views/planta') . view('Views/templates/footer');
    } else {
      return redirect()->route('home');
    };
  }

  public function getAcoes(int $id)
  {
    $this->model = \model(AcoesModel::class);
    return $this->model->getCuidados($id);
  }

  public function detalhes()
  {
    $this->model = \model(AcoesModel::class);
    $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
    $page = (\filter_input(\INPUT_GET, 'page', \FILTER_SANITIZE_NUMBER_INT)) ? \filter_input(\INPUT_GET, 'page', \FILTER_SANITIZE_NUMBER_INT) : 0 ;

    $this->data['number'] = $this->model->where('id_planta', $id)->paginate(4);
    $this->data['pager'] = $this->model->pager;
    $this->data['detalhes'] = $this->model->getDetalhes($id, $page);
    $this->data['title'] = 'Detalhes da Planta';
    $this->data['tab'] = 'Planti - Detalhes';
    $this->data['idplanta'] = $id;
    
    $this->model = \model(PlantasModel::class);
    $this->data['planta'] = $this->model->getPlantas($id);
    
    if (empty($this->data['detalhes'])) {
      return redirect()->to('planta?id=' . $id . '&r=1');
    };

    if (!is_file(APPPATH . 'Views/detalhes.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Detalhes');
    };

    return view('Views/templates/header', $this->data). view('Views/detalhes') . view('Views/templates/footer');
  }

  public function deletar()
  {
    $this->data['title'] = 'Deletar Planta';
    $this->data['tab'] = 'Planti - Deletar';
    $this->data['mensagem'] = 'Deseja mesmo deletar a planta?';
    $this->data['id'] = $_GET['id'];

    if (!is_file(APPPATH . 'Views/deletar.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Deletar');
    };

    return view('Views/templates/header', $this->data). view('Views/deletar') . view('Views/templates/footer');
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

    if (!is_file(APPPATH . 'Views/editarPlanta.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Editar Planta');
    };

    return view('Views/templates/header', $this->data). view('Views/editarPlanta') . view('Views/templates/footer');
  }

  public function adicionarCuidados()
  {
    if (!is_file(APPPATH . 'Views/adicionaCuidado.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Adiciona Cuidado');
    };

    helper('form');
    $id =  \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
    $this->data['title'] = 'Adicionar Cuidado';
    $this->data['tab'] = 'Planti - Cuidados';
    $this->data['id'] = $id;

    return view('Views/templates/header', $this->data). view('Views/adicionaCuidado') . view('Views/templates/footer');
  }

  public function editarCuidado()
  {
    $id = filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
    $this->model = \model(AcoesModel::class);
    $this->data['cuidado'] = $this->model->getCuidado($id);
    $this->data['title'] = 'Editar Cuidado';
    $this->data['tab'] = 'Planti - Cuidados';

    if (!is_file(APPPATH . 'Views/editCuidado.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Editar Cuidado');
    };

    return view('Views/templates/header', $this->data). view('Views/editCuidado') . view('Views/templates/footer');
  }
   
  public function deletarCuidado()
  {
    $id = \filter_input(\INPUT_GET, 'id', \FILTER_SANITIZE_NUMBER_INT);
    $idplanta = \filter_input(\INPUT_GET, 'idplanta', \FILTER_SANITIZE_NUMBER_INT);
    $this->model = \model(AcoesModel::class);
    $this->model->deleteCuidado($id);

    return redirect()->to('/detalhes?id=' . $idplanta);
  }

  public function cuidadosTodas()
  {
    $this->data['tab'] = 'Planti - Cuidados';
    $this->data['title'] = 'Adicionar cuidados a todas as plantas cadastradas';
    
    if (!is_file(APPPATH . 'Views/cuidados.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Cuidados');
    };

    return view('Views/templates/header.php', $this->data) . view('Views/cuidados') . view('Views/templates/footer.php');
  }

  public function cuidadosTipos()
  {
    $this->data['tab'] = 'Planti - Tipos';
    $this->data['title'] = 'Adicionar cuidados as plantas por tipo';
    $this->model = model(TiposModel::class);
    $this->data['tipos'] = $this->model->getTipos(session()->get('id'));
    
    if (!is_file(APPPATH . 'Views/cuidados.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Cuidados');
    };

    return view('Views/templates/header.php', $this->data) . view('Views/cuidadosTipos') . view('Views/templates/footer.php');
  }

  public function success()
  {
    $this->data['tab'] = 'Planti - Sucesso';
    $this->data['title'] = 'Sucesso';

    if (!is_file(APPPATH . 'Views/success.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Sucesso');
    };

    return view('Views/templates/header.php', $this->data) . view('Views/success') . view('Views/templates/footer.php');
  }

  public function successTipo()
  {
    $this->data['tab'] = 'Planti - Sucesso';
    $this->data['title'] = 'Sucesso';

    if (!is_file(APPPATH . 'Views/successTipo.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Sucesso');
    };

    return view('Views/templates/header.php', $this->data) . view('Views/successTipo') . view('Views/templates/footer.php');
  }

  public function successAction()
  {
    $this->data['tab'] = 'Planti - Sucesso';
    $this->data['title'] = 'Sucesso';

    if (!is_file(APPPATH . 'Views/successAction.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Sucesso');
    };

    return view('Views/templates/header.php', $this->data) . view('Views/successAction') . view('Views/templates/footer.php');
  }
}