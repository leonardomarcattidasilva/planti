<main class="container-fluid">
  <section>
    <h2><?=esc($title)?></h2>
    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
    <div class="col-6 offset-3">
      <form action="cuidados" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="acao" class="form-label">Cuidado:</label>
          <textarea name="acao" id="acao" class="form-control" required cols="100" rows="10"></textarea>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success float-end">Adicionar</button>
        </div>
      </form>
    </div>
  </section>
</main>