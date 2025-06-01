<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>
<main class="container-fluid">
   <section>
      <h2><?= esc($title) ?></h2>
      <?= session()->getFlashdata('error') ?>
      <?= service('validation')->listErrors() ?>
      <div class="col-6 offset-3">
         <form action="cuidadosTipo" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
               <label for="title" class="form-label">Título do cuidado:</label>
               <input type="text" name="title" id="title" class="form-control" />
            </div>
            <div class="mb-3">
               <label for="acao" class="form-label">Cuidado:</label>
               <textarea name="action" id="action" class="form-control" required cols="100" rows="5"></textarea>
            </div>
            <div class="mb-3">
               <div class="d-flex flex-row align-items-center justify-content-between">
                  <div class="d-flex flex-row align-items-end">
                     <div class="d-flex flex-column align-items-start justify-content-center">
                        <label for="type" class="form-label">Tipo:</label>
                        <select name="type" id="type" class="form-control">
                           <option value="0" selected>Selecione um tipo</option>
                           <?php
                           foreach ($types as $key => $item) { ?>
                              <option value="<?= $item['id'] ?>"><?= $item['type'] ?></option>
                           <?php }; ?>
                        </select>
                     </div>
                     <a href="<?= base_url('tipos') ?>"><button type="button" class="btn btn-sm btn-warning"><i class="fa-solid fa-plus"></i></button></a>
                  </div>
                  <div>
                     <label for="start_date" class="form-label">Feito em:</label>
                     <input type="date" name="start_date" id="" class="form-control">
                  </div>
                  <div>
                     <label for="deadline" class="form-label">Refazer em:</label>
                     <input type="date" name="deadline" id="" class="form-control">
                  </div>
               </div>
            </div>
            <button type="submit" class="btn btn-success">Adicionar Cuidado</button>
         </form>
      </div>
   </section>
</main>
<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>