<?= $this->extend('Views/layout/layout'); ?>

<?= $this->section('content') ?>
<div class="card mb-4">
  <div class="card-header">Monitoring Rapat</div>
  <!-- <?php var_dump($rapat); ?> -->
  <div class="card-body">
    <table id="datatablesSimple">
      <thead>
        <tr>
          <th>Nama Rapat</th>
          <th>Tempat</th>
          <th>Tanggal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nama Rapat</th>
          <th>Tempat</th>
          <th>Tanggal</th>
          <th>Status</th>
        </tr>
      </tfoot>
      <tbody>
        <?php
        foreach ($rapat as $rap) :
          if ($rap['tanggal'] > date('Y-m-d H:i:s')) : ?>
            <tr>
              <td><?= $rap['nama']; ?></td>
              <td><?= $rap['tempat']; ?></td>
              <td><?= $rap['tanggal']; ?></td>
              <td>
                <div class="badge bg-primary text-white rounded-pill">Akan Datang</div>
              </td>
            </tr>
          <?php else : ?>
            <tr>
              <td><?= $rap['nama']; ?></td>
              <td><?= $rap['tempat']; ?></td>
              <td><?= $rap['tanggal']; ?></td>
              <td>
                <div class="badge bg-warning text-white rounded-pill">Selesai</div>
              </td>
            </tr>
        <?php endif;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection(); ?>