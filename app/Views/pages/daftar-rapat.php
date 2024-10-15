<?= $this->extend('Views/layout/layout'); ?>

<?= $this->section('content') ?>
<div class="row">
  <?php
  // var_dump($rapat);
  if (!empty($rapat)) :
    foreach ($rapat as $rap) : ?>
      <div class="col-xl-4 mb-4">
        <div class="card lift h-100 rounded">
          <div class="card-body h-100">
            <div class="d-flex justify-content-between">
              <a class="text-decoration-none" href=" <?= base_url(); ?>/daftar-rapat/detail/<?= $rap['id']; ?>">
                <div class="row align-items-center">
                  <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                    <h5 class="text-primary"><?= $rap['nama'] ?></h5>
                    <p class="text-gray-800 mb-1"><?= $rap['tempat'] ?></p>
                    <p class="text-gray-700 mb-0"><?= $rap['tanggal'] ?></p>
                  </div>
                </div>
              </a>
              <?php if (in_groups('admin') || in_groups('ketuatim')) : ?>
                <div class="dropdown no-caret">
                  <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
                  <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
                    <a class="dropdown-item" href="<?= base_url(); ?>/rapat/delete/<?= $rap['id']; ?>">Hapus Rapat</a>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
  <?php
    endforeach;
  endif;
  ?>
  <?php if (empty($rapat)) : ?>
    <div class="text-center px-0 px-lg-5">
      <h5>Data rapat belum tersedia</h5>
      <!-- <a class="btn btn-primary p-3" href="#!">Lihat Detail</a> -->
    </div>
  <?php endif; ?>
  <!-- <div class="col-xl-4 mb-4">
    <div class="card lift h-100 rounded">
      <div class="card-body h-100">
        <div class="d-flex justify-content-between">
          <a class="text-decoration-none" href="/detail-rapat/' . $rap['id'] . '">
            <div class="row align-items-center">
              <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
              <h5 class="text-primary">' . $rap['nama'] . '</h5>
                <p class="text-gray-700 mb-0">' . $rap['tanggal'] . '</p>
              </div>
            </div>
          </a>
          <div class="dropdown no-caret">
            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
              <a class="dropdown-item" href="/rapat/delete/' . $rap['id'] . '">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</div>

<?php
$informasi = session()->getFlashdata('informasi');
if (!empty($informasi)) {
  echo $informasi;
}
?>

<?= $this->endSection(); ?>