<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>
<main id="success">
   <section>
      <h2>Sucesso</h2>
      <h3><?= $message ?></h3>
      <div>
         <a href="<?= base_url('/') ?>"><button type="button" class="btn btn-success">Home</button></a>
         <a href="<?= base_url($url) ?>"><button type="button" class="btn btn-success"><?= $novo ?></button></a>
      </div>
   </section>
</main>

<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>