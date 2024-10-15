<?= $this->extend('Views/layout/layout'); ?>

<?= $this->section('content') ?>
<!-- Example DataTable for Dashboard Demo-->
<div class="card mb-4">
  <div class="card-header">Monitoring Rapat</div>
  <!-- <?php var_dump($rapat); ?> -->
  <div class="card-body">
    <table id="datatablesSimple">
      <thead>
        <tr>
          <th>Nama Rapat</th>
          <th>Tanggal</th>
          <th>Dokumen</th>
          <th>Petugas</th>
          <th>Pembuat Rapat</th>
          <th>Status</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nama Rapat</th>
          <th>Tanggal</th>
          <th>Dokumen</th>
          <th>Petugas</th>
          <th>Pembuat Rapat</th>
          <th>Status</th>
        </tr>
      </tfoot>
      <tbody>
        <?php

        use App\Models\UserModel;

        $user_model = new UserModel();
        foreach ($rapat as $rap) :
          $arrayUser_create = $user_model->get_user_nama($rap['created_id']);
          if ($rap['notula'] == '0') : ?>
            <tr>
              <td><?= $rap['nama']; ?></td>
              <td><?= $rap['tanggal']; ?></td>
              <td>Notula Rapat</td>
              <?php $arrayUser = $user_model->get_user_nama($rap['notula_id']) ?>
              <td><?php if ($arrayUser) echo $arrayUser[0]['username'] ?></td>
              <td><?php if ($arrayUser_create) echo $arrayUser_create[0]['username'] ?></td>
              <td>
                <div class="badge bg-danger text-white rounded-pill">Belum Upload</div>
              </td>
            </tr>
          <?php endif; ?>
          <?php if ($rap['dokum_link'] == '0') : ?>
            <tr>
              <td><?= $rap['nama']; ?></td>
              <td><?= $rap['tanggal']; ?></td>
              <td>Link Dokumentasi</td>
              <?php $arrayUser_link = $user_model->get_user_nama($rap['dokum_id']) ?>
              <td><?php if ($arrayUser_link) echo $arrayUser_link[0]['username'] ?></td>
              <td><?php if ($arrayUser_create) echo $arrayUser_create[0]['username'] ?></td>
              <td>
                <div class="badge bg-danger text-white rounded-pill">Belum Upload</div>
              </td>
            </tr>
          <?php endif; ?>
          <!-- <?php if ($rap['atk'] == '0') : ?>
            <tr>
              <td><?= $rap['nama']; ?></td>
              <td><?= $rap['tanggal']; ?></td>
              <td>ATK</td>
              <td>Pembuat ATK</td>
              <td>
                <div class="badge bg-danger text-white rounded-pill">Belum Upload</div>
              </td>
            </tr>
        <?php endif; ?> -->
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- <script>
  var linkSource = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,'+ response.data ;
var downloadLink = document.createElement("a");
var fileName = 'clients.' + format;

downloadLink.href = linkSource;
downloadLink.download = fileName;
downloadLink.click();
</script> -->

<?= $this->endSection(); ?>