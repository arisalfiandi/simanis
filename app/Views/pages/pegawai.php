<?= $this->extend('Views/layout/layout'); ?>

<?= $this->section('content') ?>
<div class="card mb-4">
  <div class="card-header">
    <div class="d-flex justify-content-between">
      <p>Daftar Pegawai</p>
      <a href="<?= url_to('register') ?>" class="btn btn-success">Tambah Pegawai <div><i data-feather="user"></i></div></a>
    </div>
  </div>
  <div class="card-body">
    <!-- Item 1-->
    <?php

    use App\Models\UserGroupModel;

    $model = new UserGroupModel();
    ?>
    <?php foreach ($user as $pegawai) : ?>
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center flex-shrink-0 me-3">
          <div class="avatar avatar-xl me-3 bg-gray-200"><i style="font-size: 30px;" data-feather="user"></i></div>
          <div class="d-flex flex-column fw-bold">
            <a class="text-dark line-height-normal mb-1" href="#!"><?= $pegawai['username']; ?></a>
            <?php if ($model->get_role($pegawai['id'])['group_id'] == "3") : ?>
              <div class="small text-muted line-height-normal">Pegawai</div>
            <?php endif; ?>
            <?php if ($model->get_role($pegawai['id'])['group_id'] == "2") : ?>
              <div class="small text-muted line-height-normal">Ketua Tim</div>
            <?php endif; ?>
            <?php if (($model->get_role($pegawai['id'])['group_id'] == "2") && ($pegawai['id'] == '1')) : ?>
              <div class="small text-muted line-height-normal">Kepala</div>
            <?php endif; ?>
            <?php if ($model->get_role($pegawai['id'])['group_id'] == "1") : ?>
              <div class="small text-muted line-height-normal">Admin</div>
            <?php endif; ?>
          </div>
        </div>
        <div class="dropdown no-caret">
          <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
          <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
            <a class="dropdown-item" href="<?= base_url('pegawai/delete/' . $pegawai['id']) ?>">Hapus Pegawai</a>
            <?php if ($model->get_role($pegawai['id'])['group_id'] == "3") : ?>
              <a class="dropdown-item" href="<?= base_url('pegawai/update-ketuatim/' . $pegawai['id']) ?>">Jadikan Ketua Tim</a>
            <?php endif; ?>
            <?php if ($model->get_role($pegawai['id'])['group_id'] == "2") : ?>
              <a class="dropdown-item" href="<?= base_url('pegawai/update-pegawai/' . $pegawai['id']) ?>">Jadikan Pegawai</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php
$informasi = session()->getFlashdata('informasi');
if (!empty($informasi)) {
  echo $informasi;
}
?>

<?= $this->endSection(); ?>