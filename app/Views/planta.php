<main>
   <section>
      <h2>Sua plantinha</h2>
      <div class="card" id="card_planta">
         <div class="card_head">
            <img src="https://cdn-icons-png.flaticon.com/512/628/628283.png" alt="<?= $planta['name'] ?>">
         </div>
         <div class="card_body">
            <h5 class="card_title"><?= $planta['name'] ?></h5>
            <ol>
               <?php

               if (count($cuidados) > 0) {
                  foreach ($cuidados as $key => $value) { ?>
                     <li class="card_text"><?= $value['title'] ?></li>
                  <?php  }
               } else { ?>
                  <p>Não há cuidados cadastrados!</p>
               <?php } ?>
            </ol>
            <div class="card_footer">
               <a href="detalhes?id=<?= $_GET['id'] ?>" id="btn_detalhes" class="btn btn-success"><i class="fa-solid fa-list"></i> Cuidados - Detalhes</a>
               <a href="adicionarCuidados?id=<?= $_GET['id'] ?>" class="btn btn-success"><i class="fa-solid fa-plus"></i> Adicionar Cuidados</a>
               <a href="editar?id=<?= $_GET['id'] ?>" id="btn_detalhes" class="btn btn-success"><i class="fa-solid fa-pencil"></i> Editar Nome</a>
               <a href="deletar?id=<?= $_GET['id'] ?>" id="btn_detalhes" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Deletar Planta</a>
            </div>
         </div>
      </div>
      <?php
      if (!empty($mensagem)) { ?>
         <h3><?= $mensagem ?></h3>
      <?php }; ?>
   </section>
</main>