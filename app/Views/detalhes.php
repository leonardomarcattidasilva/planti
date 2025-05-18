<?php

use CodeIgniter\I18n\Time;
?>

<main id="detalhes">
   <section>
      <div>
         <h2><?= $title ?> - <?= $planta['name'] ?></h2>
         <?= $pager->links() ?>
      </div>
      <div id="lista_detalhes">
         <?php
         if (!empty($detalhes)) {
            foreach ($detalhes as $key => $value) { ?>
               <div class="card_detalhes">
                  <div>
                     <h5><?= $value['title'] ?></h5>
                     <p><?= $value['action'] ?></p>
                     <p>Feito em: <?= Time::parse($value['start_date'], 'America/Sao_Paulo')->format('d/m/y');  ?></p>
                     <p>Repetir em: <?= Time::parse($value['deadline'], 'America/Sao_Paulo')->format('d/m/y');  ?></p>

                  </div>
                  <hr>
                  <div>
                     <a href="editarCuidado?id=<?= $value['id'] ?>&id_plant=<?= $id_plant ?>" id="btn_detalhes" class="btn btn-success">Editar</a>
                     <?php
                     if ($value['deadline'] <= Time::today()->toDateString() && !$value['done']) { ?>
                        <button type="button" class="btn btn-warning"><a href="<?= site_url('done?id=' . $value['id']) ?>">Feito</a></button>
                     <?php } ?>
                     <button type="button" class="btn btn-danger btnDelCuidado" data-bs-toggle="modal" data-bs-target="#delCuidadoModal" value="<?= $value['id'] ?>">Deletar</button>
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
                  <a href="deletarCuidado?id_plant=<?= $id_plant ?>&id=" class="btn btn-danger" id="delLink">Deletar</a>
               </div>
            </div>
         </div>
      </div>
   </aside>
</main>