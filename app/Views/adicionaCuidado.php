<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>
<main class="container-fluid">
   <section>
      <h2><?= esc($title) ?></h2>
      <?= session()->getFlashdata('error') ?>
      <?= validation_list_errors() ?>
      <div class="col-4 offset-4">
         <form action="cadastrarCuidado?id=<?= $id ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
               <input type="number" name="id_plant" id="id_plant" value="<?= $_GET['id'] ?>" hidden>
               <div class="mb-3">
                  <label for="title" class="form-label">Title:</label>
                  <input type="text" name="title" id="title" class="form-control" />
               </div>
               <label for="action" class="form-label">Cuidado:</label>
               <textarea name="action" id="action" class="form-control" cols="30" rows="5"></textarea>
               <small><?= session()->get('err')['action'] ?? '' ?></small>
               <div class="d-flex flex-row justify-content-between mb-3">
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
            <div class="mb-3">
               <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
         </form>
      </div>
   </section>
</main>
<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>