<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('cadastrar', 'ActionsController::cadastrar', ['as' => 'cadastrar']);
$routes->post('updatePlanta', 'ActionsController::updatePlanta');
$routes->post('confirmadeletar', 'ActionsController::confirmaDeletar');
$routes->post('cadastrarCuidado', 'ActionsController::cadastrarCuidado', ['as' => 'cadastrarCuidado']);
$routes->post('updateCuidado', 'ActionsController::updateCuidado');
$routes->post('cuidados', 'ActionsController::cuidadosTodas', ['as' => 'cuidadosTodas']);
$routes->post('cadastrarTipo', 'ActionsController::cadastrarTipo', ['as' => 'cadastrarTipo']);
$routes->post('cuidadosTipo', 'ActionsController::cuidadosTipo');
$routes->post('loginAction', 'AuthController::loginAction', ['as' => 'loginAction']);
$routes->post('logupAction', 'AuthController::logupAction', ['as' => 'logupAction']);


$routes->get('done', 'ActionsController::done', ['as' => 'done']);
$routes->get('/', 'PagesController::home', ['as' => 'home']);
$routes->get('tipos', 'PagesController::cadastroTipos', ['as' => 'tipo']);
$routes->get('cadastroPlanta', 'PagesController::cadastroPlanta', ['as' => 'cadastroPlanta']);
$routes->get('planta', 'PagesController::verPlanta');
$routes->get('detalhes', 'PagesController::detalhes', ['as' => 'detalhes']);
$routes->get('deletar', 'PagesController::deletar');
$routes->get('editar', 'PagesController::getPlanta');
$routes->get('adicionarCuidados', 'PagesController::adicionarCuidados', ['as' => 'addCuidados']);
$routes->get('editarCuidado', 'ActionsController::editarCuidado');
$routes->get('deletarCuidado', 'ActionsController::deletarCuidado');
$routes->get('cuidadosTodas', 'PagesController::cuidadosTodas');
$routes->get('cuidadosTipos', 'PagesController::cuidadosTipos');
$routes->get('success', 'PagesController::success', ['as' => 'success']);
$routes->get('/login', 'PagesController::login', ['as' => 'login']);
$routes->get('/logup', 'PagesController::logup', ['as' => 'logup']);
$routes->get('/logout', 'AuthController::logout', ['as' => 'logout']);
