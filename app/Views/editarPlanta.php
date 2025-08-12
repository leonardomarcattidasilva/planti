<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>
<main>
   <section>
      <h2><?= $title ?></h2>
      <?= session()->getFlashdata('error') ?>
      <?= service('validation')->listErrors() ?>
      <div class="col-3">
         <form action="updatePlanta" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
               <input type="number" name="id" id="id" value="<?= $id ?>" hidden>
               <label for="name" class="form-label">Nome:</label>
               <input type="text" name="name" id="name" value="<?= $planta['name'] ?>" class="form-control">
               <small class="small"><?= session()->getTempdata('err')['name'] ?? '' ?></small>
            </div>
            <div class="mb-3">
               <button type="submit" class="btn btn-success">Editar Nome</button>

            </div>
         </form>
      </div>
   </section>
</main>

<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>