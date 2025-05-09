<main class="container-fluid">
  <section>
    <h2><?=esc($title)?></h2>
    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>
    <div class="col-4 offset-4">
      <form action="cadastrarCuidado?id=<?=$id?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
        <input type="number" name="id" id="id" value="<?=$id?>" hidden>
          <label for="acao" class="form-label">Cuidado:</label>
          <textarea name="acao" id="acao" class="form-control" cols="30" rows="10"></textarea>
          <small><?= session()->get('err')['acao'] ?? '' ?></small>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success float-end">Cadastrar</button>
        </div>
      </form>
    </div>
  </section>
</main>