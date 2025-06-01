<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>

<main class="container-fluid">
   <section>
      <h2><?= esc($title) ?></h2>
      <?= session()->getFlashdata('error') ?>
      <?= service('validation')->listErrors() ?>
      <div class="col-4 offset-4">
         <form action="cuidados" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
               <label for="title" class="form-label">Title:</label>
               <input type="text" name="title" id="title" class="form-control" />
            </div>
            <div class="mb-3">
               <label for="acao" class="form-label">Cuidado:</label>
               <textarea name="acao" id="acao" class="form-control" required cols="100" rows="5"></textarea>
            </div>
            <div class="d-flex flex-row justify-content-around mb-3">
               <div>
                  <label for="start_date" class="form-label">Feito em:</label>
                  <input type="date" name="start_date" id="" class="form-control">
               </div>
               <div>
                  <label for="deadline" class="form-label">Refazer em:</label>
                  <input type="date" name="deadline" id="" class="form-control">
               </div>
            </div>
            <button type="submit" class="btn btn-success">Adicionar</button>
         </form>
      </div>
   </section>
</main>

<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>