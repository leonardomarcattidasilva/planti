<main id="detalhes">
  <section>
    <div>
      <h2><?=$title?> - <?=$planta['nome']?></h2>
      <?= $pager->links() ?>
    </div>
    <div id="lista_detalhes">
      <?php
        if (!empty($detalhes)) {
          foreach ($detalhes as $key => $value) {?>
            <div class="card_detalhes">
              <div>
                <h5>Cuidado <?=$value['id']?></h5>
                <p><?=$value['acao']?></p>
              </div>
              <hr>
              <div>
                <a href="editarCuidado?id=<?=$value['id']?>&idplanta=<?=$idplanta?>" id="btn_detalhes" class="btn btn-success">Editar</a>
                <button type="button" class="btn btn-danger btnDelCuidado" data-bs-toggle="modal" data-bs-target="#delCuidadoModal" value="<?=$value['id']?>">Deletar</button>
              </div>
            </div>
      <?php };
      }; ?>
    </div>
  </section>
  <aside>
  <!-- Modal -->
  <div class="modal fade" id="delCuidadoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Deseja mesmo deletar?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
          <a href="deletarCuidado?idplanta=<?=$idplanta?>&id=" class="btn btn-danger" id="delLink">Deletar</a>
        </div>
      </div>
    </div>
  </div>
  </aside>
</main>