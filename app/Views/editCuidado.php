<main class="container-fluid">
   <section>
      <h2><?= esc($title) ?></h2>
      <?= session()->getFlashdata('error') ?>
      <?= service('validation')->listErrors() ?>
      <div class="col-4 offset-4">
         <form action="updateCuidado" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
               <input type="number" name="id" id="id" value="<?= $_GET['id'] ?>" hidden>
               <input type="number" name="id_plant" id="idplanta" value="<?= $_GET['id_plant'] ?>" hidden>
               <label for="action" class="form-label">Cuidado:</label>
               <textarea name="action" id="action" class="form-control" required cols="30" rows="10"><?= $cuidado['action'] ?></textarea>
            </div>
            <div class="mb-3 d-flex flex-row justify-content-between">
               <div>
                  <label for="start_date" class="form-label">Feito em:</label>
                  <input type="date" name="start_date" id="" class="form-control" value="<?= $cuidado['start_date'] ?>" />
               </div>
               <div>
                  <label for="start_date" class="form-label">Repetir em:</label>
                  <input type="date" name="deadline" id="deadline" class="form-control" value="<?= $cuidado['deadline'] ?>" />
               </div>
            </div>
            <div class="mb-3">
               <button type="submit" class="btn btn-success">Editar</button>
            </div>
         </form>
      </div>
   </section>
</main>