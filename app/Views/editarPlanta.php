<main>
  <section>
    <h2><?=$title?></h2>
    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
    <div class="col-3">
      <form action="updatePlanta" method="post">
      <?= csrf_field() ?>
        <div class="mb-3">
          <input type="number" name="id" id="id" value="<?=$id?>" hidden>
          <label for="nome" class="form-label">Nome:</label>
          <input type="text" name="nome" id="nome" value="<?=$planta['nome']?>" class="form-control">
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success">Editar Nome</button>
          
        </div>
      </form>
    </div>
  </section>
</main>