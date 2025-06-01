<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>
<?= $this->include('templates/header') ?>
<main id="success">
   <section>
      <h2><?= $title ?></h2>
      <h3>Cadastro de tipo efetuado!</h3>
      <div>
         <a href="<?= base_url('/') ?>"><button type="button" class="btn btn-success">Home</button></a>
         <a href="<?= base_url('/tipos') ?>"><button type="button" class="btn btn-success">Novo Cadastro</button></a>
      </div>
   </section>
</main>

<?= $this->include('templates/footer') ?>
<?= $this->endSection('content') ?>