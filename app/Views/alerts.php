<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>
<main class="container-fluid">
   <section>
      <h2><?= esc($title) ?></h2>
      <div class="col-4 offset-4">
         <ol>
            <?php
            foreach ($alerts as $key => $alert) { ?>
               <li>
                  <h6><?= $alert->name ?></h6>
                  <a href="<?= site_url('detalhes?id=' . $alert->id_plant) ?>"><?= $alert->action ?></a>
               </li>
            <?php }
            ?>
         </ol>
      </div>
   </section>
</main>
?>
<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>