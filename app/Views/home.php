<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>
<main>
   <section>
      <h2>Consulte sua Planta</h2>
      <div class="col-4 offset-4">
         <form action="planta" method="get" id="form_consulta">
            <?= session()->getFlashdata('error') ?>
            <?= service('validation')->listErrors() ?>
            <div class="mb-3">
               <label for="planta" class="form-label">Planta:</label>
               <select name="id" id="planta" class="form-control">
                  <option value="0" selected>Selecione</option>
                  <?php
                  if (!empty($plantas)) {
                     foreach ($plantas as $key => $planta) { ?>
                        <option value="<?= esc($planta['id']) ?>"><?= esc($planta['name']) ?></option>
                     <?php
                     };
                  } else { ?>
                     <option value="">Não há plantas cadastradas</option>
                  <?php  };
                  ?>
               </select>
            </div>
            <div class="mb-3 d-flex justify-content-end">
               <button type="submit" class="btn btn-success" id="btn_consulta">Consultar</button>
            </div>
         </form>
      </div>
   </section>
   <?php
   if (count($alerts) > 0) { ?>
      <a href="<?= base_url('alerts') ?>">
         <div class="alerts">
            <i class="fa-solid fa-bell"></i>
         </div>
      </a>
   <?php } ?>
</main>

<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>