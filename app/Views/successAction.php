<main id="success">
  <?php
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  ?>
  <section>
    <h2><?=$title?></h2>
    <h3>Cuidado cadastrado com sucesso!</h3>
    <div>
      <a href="<?=base_url('/')?>"><button type="button" class="btn btn-success">Home</button></a>
      <a href="<?=base_url('/adicionarCuidados?id=' . $id)?>"><button type="button" class="btn btn-success">Adicionar Cuidado</button></a>
    </div>
  </section>
</main>