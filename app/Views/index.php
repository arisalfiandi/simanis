<?= $this->extend('Views/landing_page/_partials/layout'); ?>

<?= $this->section('content') ?>
<div class="card card-icon">
  <div class="row no-gutters">
    <div class="col-auto card-icon-aside bg-primary">
      <i data-feather="layers"></i>
    </div>
    <div class="col">
      <div class="card-body py-5">
        <h5 class="card-title">Custom Icon Card</h5>
        <p class="card-text">...</p>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>