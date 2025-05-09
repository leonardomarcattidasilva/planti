<main id="del_planta">
  <section>
    <h2><?=$title?></h2>
    <?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
      <form action="confirmadeletar" method="post">
      <?= csrf_field() ?>
        <div class="mb-3">
          <input type="number" name="id" id="id" value="<?=$id?>" hidden>
          <p><?=$mensagem?></p>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-danger">Deletar</button>
          <a href="planta?id=<?=$id?>"><button type="button" class="btn btn-success">Voltar</button></a>
        </div>
      </form>
  </section>
</main>