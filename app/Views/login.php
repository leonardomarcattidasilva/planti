<main id="login">
   <section class="col-4 offset-4">
      <?= session()->getFlashdata('error') ?>
      <?= service('validation')->listErrors() ?>
      <div id="flashbad">
         <p><?= session()->getFlashdata('bad_email') ?? '' ?></p>
      </div>
      <form action="loginAction" method="post" id="form_login">
         <?= csrf_field() ?>
         <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email') ?>">
            <small class="small"><?= session()->getTempdata('err')['email'] ?? '' ?></small>
         </div>
         <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="small"><?= session()->getTempdata('err')['password'] ?? '' ?></small>
         </div>
         <div class="mb-3 clear-both">
            <button type="reset" class="btn btn-danger float-end" id="btn_clear">Limpar</button>
            <button type="submit" class="btn btn-success float-end" id="btn_login">Login</button>
            <a href="logup" class="btn btn-warning">Cadastre-se</a>
         </div>
      </form>
   </section>
</main>