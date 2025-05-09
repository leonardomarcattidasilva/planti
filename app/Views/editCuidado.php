<main class="container-fluid">
  <section>
    <h2><?=esc($title)?></h2>
    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
    <div class="col-4 offset-4">
      <form action="updateCuidado" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
        <input type="number" name="id" id="id" value="<?=$_GET['id']?>" hidden>
        <input type="number" name="idplanta" id="idplanta" value="<?=$_GET['idplanta']?>" hidden>
          <label for="acao" class="form-label">Cuidado:</label>
          <textarea name="acao" id="acao" class="form-control" required cols="30" rows="10"><?=$cuidado['acao']?></textarea>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success float-end">Editar</button>
        </div>
      </form>
    </div>
  </section>
</main>