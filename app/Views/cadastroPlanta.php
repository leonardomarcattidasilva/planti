<main class="container-fluid">
  <section>
    <h2><?=esc($title)?></h2>
    <?= session()->getFlashdata('error') ?>
    <div class="col-4 offset-4">
      <form action="cadastrar" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="planta" class="form-label">Planta:</label>
          <input type="text" name="planta" id="planta" class="form-control" >
          <small class="small"><?= session()->get('err')['planta'] ?? '' ?></small>
          <?php
            if (isset(validation_errors()['planta'])) {?>
                <small><?=validation_errors()['planta']?></small>
           <?php }
          ?>
        </div>
        <div class="mb-3 col-6">
          <label for="tipo" class="form-label">Tipo:</label>
          <select name="tipo" id="tipo" class="form-control" required>
            <?php
              if (isset($tipos) && count($tipos) > 0) {
                foreach ($tipos as $key => $value) { ?>
                  <option value="<?=$value['id']?>"><?=$value['tipo']?></option>
              <?php };
                } else { ?>
                  <option value=0 selected disabled>Não há tipos cadastrados</option>
              <?php  };
            ?>
          </select>
        </div>
        <a href="<?= base_url('tipos') ?>"><button type="button" class="btn btn-warning">Cadastrar Tipo</button></a>
        <div class="mb-3">
          <button type="submit" class="btn btn-success float-end">Cadastrar</button>
        </div>
      </form>
    </div>
  </section>
</main>