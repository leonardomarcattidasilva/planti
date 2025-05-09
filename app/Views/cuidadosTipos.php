<main class="container-fluid">
  <section>
    <h2><?=esc($title)?></h2>
    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
    <div class="col-6 offset-3">
      <form action="cuidadosTipo" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="acao" class="form-label">Cuidado:</label>
          <textarea name="acao" id="acao" class="form-control" required cols="100" rows="10"></textarea>
        </div>
        <div class="mb-3 col-6">
          <label for="tipo" class="form-label">Tipo:</label>
          <select name="tipo" id="tipo" class="form-control">
            <option value="0" selected>Selecione um tipo</option>
            <?php
              foreach ($tipos as $key => $item) { ?>
                <option value="<?=$item['id']?>"><?=$item['tipo']?></option>
            <?php }; ?>
          </select>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success float-start">Adicionar</button>
        </div>
      </form>
    </div>
  </section>
</main>