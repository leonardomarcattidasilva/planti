<main>
   <section>
      <h2>Consulte sua Planta</h2>
      <div class="col-4 offset-4">
         <form action="planta" method="get" id="form_consulta">
            <?= session()->getFlashdata('error') ?>
            <?= service('validation')->listErrors() ?>
            <div class="mb-3">
               <label for="planta" class="form-label">Planta:</label>
               <select name="id" id="planta" class="form-control">
                  <option value="0" selected>Selecione</option>
                  <?php
                  if (!empty($plantas)) {
                     foreach ($plantas as $key => $planta) { ?>
                        <option value="<?= esc($planta['id']) ?>"><?= esc($planta['name']) ?></option>
                     <?php
                     };
                  } else { ?>
                     <option value="">Não há plantas cadastradas</option>
                  <?php  };
                  ?>
               </select>
            </div>
            <div class="mb-3 d-flex justify-content-end">
               <button type="submit" class="btn btn-success" id="btn_consulta">Consultar</button>
            </div>
         </form>
      </div>
   </section>
</main>

<?php
if (count($alerts) > 0) { ?>
   <div class="alerts">
      <ol>
         <?php
         foreach ($alerts as $key => $alert) { ?>
            <li>
               <a href="<?= site_url('detalhes?id=' . $alert->id_plant) ?>"><?= $alert->action ?></a>
            </li>
         <?php } ?>
      </ol>
   </div>
<?php } ?>