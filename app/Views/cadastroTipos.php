<main class="container-fluid">
   <section>
      <h2><?= esc($title) ?></h2>
      <?= session()->getFlashdata('error') ?>
      <div class="col-4 offset-4">
         <form action="cadastrarTipo" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
               <label for="type" class="form-label">Tipo:</label>
               <input type="text" name="type" id="type" class="form-control">
               <small class="small"><?= session()->get('err')['type'] ?? '' ?></small>
            </div>
            <div class="mb-3 d-flex justify-content-end">
               <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
         </form>
      </div>
   </section>
</main>