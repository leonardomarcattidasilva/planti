<?= $this->extend('layout/layout') ?>

<?= $this->section('header') ?>

<header>
   <?php
   if (session()->get('id')) { ?>
      <div id="home_logo">
         <a href="<?= base_url('/') ?>">
            <h1>Planti</h1>
            <img src="https://www.iconpacks.net/icons/2/free-plant-icon-1573-thumb.png" alt="">
         </a>
      </div>
      <div id="headerRight">
         <p>Bem vindo <?= session()->get('name'); ?></p>
         <div class="dropdown">
            <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Planti
            </a>
            <ul class="dropdown-menu">
               <li>
                  <a class="dropdown-item" href="<?= base_url('tipos') ?>">
                     <i class="fa-solid fa-ellipsis-vertical"></i> Cadastro de Tipos
                  </a>
               </li>
               <li>
                  <a class="dropdown-item" href="<?= base_url('cadastroPlanta') ?>">
                     <i class="fa-solid fa-leaf"></i> Cadastro de Plantas
                  </a>
               </li>
               <li>
                  <hr class="dropdown-divider">
               </li>
               <li>
                  <a class="dropdown-item" href="<?= base_url('cuidadosTipos') ?>">
                     <i class="fa-solid fa-check-double"></i> Cuidados - Por Tipo
                  </a>
               </li>
               <li>
                  <a class="dropdown-item" href="<?= base_url('cuidadosTodas') ?>">
                     <i class="fa-solid fa-check-double"></i> Cuidados - Todas
                  </a>
               </li>
               <li>
                  <hr class="dropdown-divider">
               </li>
               <li>
                  <a href="" class="dropdown-item editUser">
                     <i class="fa-solid fa-user-pen"></i> Editar Usuário/Senha
                  </a>
               </li>
               <li>
                  <hr class="dropdown-divider">
               </li>
               <li>
                  <a class="dropdown-item logout" href="<?= base_url('logout') ?>">
                     <i class="fa-solid fa-power-off"></i> Logout
                  </a>
               </li>

            </ul>
         </div>
      </div>
   <?php }
   if (!session()->get('id')) { ?>
      <h1>Login</h1>
   <?php } ?>
</header>

<?= $this->endSection() ?>