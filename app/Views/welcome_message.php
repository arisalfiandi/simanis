<?= $this->extend('Views/layout/layout'); ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-xl-12 mb-5">
    <a href="<?= base_url() ?>/beranda/tabel" class="text-decoration-none text-gray-500">
      <div class="card card-icon lift h-100">
        <div class="row no-gutters">
          <div class="col-auto card-icon-aside bg-icon">
            <i data-feather="mail"></i>
          </div>
          <div class="col">
            <div class="card-body py-5">
              <h5 class="card-title">Undangan Rapat Mendatang</h5>
              <p class="card-text"><?= $rapat_mendatang; ?></p>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-xl-12 mb-5">
    <a href="<?= base_url() ?>/beranda/tabel" class="text-decoration-none text-gray-500">
      <div class="card card-icon lift h-100">
        <div class="row no-gutters">
          <div class="col-auto card-icon-aside bg-icon">
            <i data-feather="layers"></i>
          </div>
          <div class="col">
            <div class="card-body py-5">
              <h5 class="card-title">Jumlah Seluruh Undangan Rapat</h5>
              <p class="card-text"><?= $rapat_all; ?></p>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>

<div class="row">
  <div class="col-xl-12 mb-4">

    <!-- Pie chart with legend example-->
    <div class="card h-100">
      <div class="card-header">Rapat Terbaru</div>
      <div class="card-body">
        <?php if (!empty($rapat_terbaru)) : ?>
          <img class=" img-fluid rounded mx-auto d-block mb-4" width="220" src="<?= base_url() ?>assets/img/illustrations/workshop1.png" alt="">
          <div class="text-center px-0 px-lg-5">
            <h5>Rapat terbaru tersedia</h5>
            <h5 class="my-4"><strong><?= $rapat_terbaru[0]['nama']; ?></strong></h5>
            <p class="mb-4">Lokasi:</p>
            <h5 class="mb-4"><strong><?= $rapat_terbaru[0]['tempat']; ?></strong></h5>
            <!-- <a class="btn btn-primary p-3" href="#!">Lihat Detail</a> -->
          </div>
        <?php endif; ?>
        <?php if (empty($rapat_terbaru)) : ?>
          <img class=" img-fluid rounded mx-auto d-block mb-4" width="220" src="<?= base_url() ?>assets/img/illustrations/happiness.png" alt="">
          <div class="text-center px-0 px-lg-5">
            <h5>Tidak tersedia rapat terbaru</h5>
            <!-- <a class="btn btn-primary p-3" href="#!">Lihat Detail</a> -->
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-xl-12 mb-4">
    <!-- Dashboard activity timeline example-->
    <div class="card card-header-actions h-100">
      <div class="card-header">
        Aktivitas Terbaru
        <a href="<?= base_url() ?>/beranda/tabel" class="text-decoration-none text-gray-500 btn btn-light">Lihat Semua</a>
      </div>
      <div class="card-body">
        <div class="timeline timeline-xs">
          <?php foreach ($rapat_tujuh as $tujuh) : ?>
            <!-- Timeline Item 1-->
            <div class="timeline-item">
              <div class="timeline-item-marker">
                <div class="timeline-item-marker-text me-5"><?= $tujuh['tanggal']; ?></div>
                <div class="timeline-item-marker-indicator bg-green"></div>
              </div>
              <div class="timeline-item-content">
                <strong>
                  <?= $tujuh['nama']; ?>
                </strong>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  
</div>
<?= $this->endSection(); ?>