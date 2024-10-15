<?= $this->extend('Views/layout/layout'); ?>

<?= $this->section('content') ?>
<!-- Example DataTable for Dashboard Demo-->
<div class="card mb-4">
  <!-- card header -->
  <div class="card-header">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/daftar-rapat">Rapat</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $detail['nama']; ?></li>
      </ol>
    </nav>
    <div class="text-black">
      <?php

      use App\Models\UserModel;

      $user_model = new UserModel();
      $arrayUser = $user_model->get_user_nama($detail['created_id']);

      ?>
      dibuat oleh: <?= $arrayUser[0]['username']; ?>
    </div>
  </div>
  <div class="card-body ">
    <div class="d-flex justify-content-between mb-3">
      <h6 class="text-black">
        Nama Dokumen
      </h6>
      <h6 class="text-black">
        Aksi
      </h6>
    </div>
    <div class="d-flex justify-content-between mb-3">
      <div>
        Surat Undangan
      </div>
      <div class="d-flex">
        <!-- <button name="undangan" class="btn btn-datatable undangan btn-icon btn-primary"><i data-feather="eye"></i></button> -->
        <a href="<?= base_url(); ?>/file/<?= $detail['id']; ?>/surat_undangan/Surat Undangan <?= $detail['nama']; ?>.xls" class="badge bg-info text-white rounded-pill" download>Template Surat Undangan <i data-feather="download"></i></a>
        <div class="badge bg-danger text-white rounded-pill <?= $detail['surat_undangan'] ? "d-none" : " " ?> ms-3">Belum Tersedia</div>
        <a href="/<?= $detail['surat_undangan']; ?>" class="btn btn-datatable btn-icon btn-success ms-3 <?= $detail['surat_undangan'] ? " " : "d-none" ?>" download><i data-feather="download"></i></a>
        <?php if (in_groups('admin') || in_groups('ketuatim') ||  $detail['notula_id'] == session()->get('id')) : ?>
          <button data-bs-toggle="modal" data-bs-target="#modal-add-su" class="btn btn-datatable btn-icon btn-light ms-3"><i data-feather="plus"></i></button>
          <button data-bs-toggle="modal" data-bs-target="#modal-delete-su" class="btn btn-datatable btn-icon btn-danger ms-3"><i data-feather="trash-2"></i></button>
        <?php endif; ?>
      </div>
    </div>
    <div class="d-flex justify-content-between mb-3">
      <div>
        Daftar Hadir
      </div>
      <div class="d-flex">
        <!-- <button name="hadir" class="btn btn-datatable daftar btn-icon btn-primary"><i data-feather="eye"></i></button> -->
        <a href="<?= base_url(); ?>/file/<?= $detail['id']; ?>/daftar_hadir/Daftar Hadir <?= $detail['nama']; ?>.xls" class="badge bg-info text-white rounded-pill" download>Template Daftar Hadir<i data-feather="download"></i></a>
        <div class="badge bg-danger text-white rounded-pill <?= $detail['daftar_hadir'] ? "d-none" : " " ?> ms-3">Belum Tersedia</div>
        <a href="/<?= $detail['daftar_hadir']; ?>" class="btn btn-datatable btn-icon btn-success ms-3 <?= $detail['daftar_hadir'] ? " " : "d-none" ?>" download><i data-feather="download"></i></a>
        <?php if (in_groups('admin') || in_groups('ketuatim') ||  $detail['notula_id'] == session()->get('id')) : ?>
          <button data-bs-toggle="modal" data-bs-target="#modal-add-daftar" class="btn btn-datatable btn-icon btn-light ms-3"><i data-feather="plus"></i></button>
          <button data-bs-toggle="modal" data-bs-target="#modal-delete-daftar" class="btn btn-datatable btn-icon btn-danger ms-3"><i data-feather="trash-2"></i></button>
        <?php endif; ?>
      </div>
    </div>
    <div class="d-flex justify-content-between mb-3">
      <div>
        Link Dokumentasi
      </div>
      <div class="d-flex">
        <div class="badge bg-danger text-white rounded-pill <?= $detail['dokum_link'] ? "d-none" : " " ?> ms-3">Belum Tersedia</div>
        <button class="btn btn-datatable btn-icon link btn-primary <?= $detail['dokum_link'] ? " " : "d-none" ?>"><i data-feather="eye"></i></button>
        <!-- <a href="/file/tes.pdf" class="btn btn-datatable btn-icon btn-success ms-3" download><i data-feather="download"></i></a> -->
        <?php if (in_groups('admin') || in_groups('ketuatim') || $detail['dokum_id'] == session()->get('id')) : ?>
          <button class="btn btn-datatable btn-icon btn-light ms-3" data-bs-toggle="modal" data-bs-target="#modal-add-link"><i data-feather="plus"></i></button>
          <button data-bs-toggle="modal" data-bs-target="#modal-delete-link" class="btn btn-datatable btn-icon btn-danger ms-3"><i data-feather="trash-2"></i></button>
        <?php endif; ?>
      </div>
    </div>
    <div class="d-flex justify-content-between mb-3">
      <div>
        Notula
      </div>
      <div class="d-flex">
        <a href="<?= base_url(); ?>/file/template/Notulen Rapat Dinas.docx" class="badge bg-info text-white rounded-pill" download>Template Notula<i data-feather="download"></i></a>
        <div class="badge bg-danger text-white rounded-pill <?= $detail['notula'] ? "d-none" : " " ?> ms-3">Belum Tersedia</div>
        <button name="notula" class="btn notula btn-datatable btn-icon btn-primary <?= $detail['notula'] ? " " : "d-none" ?> ms-3"><i data-feather="eye"></i></button>
        <a href="/<?= $detail['notula']; ?>" class="btn btn-datatable btn-icon btn-success ms-3 <?= $detail['notula'] ? " " : "d-none" ?>" download><i data-feather="download"></i></a>
        <?php if (in_groups('admin') || in_groups('ketuatim') ||  $detail['notula_id'] == session()->get('id')) : ?>
          <button data-bs-toggle="modal" data-bs-target="#modal-add-notula" class="btn btn-datatable btn-icon btn-light ms-3"><i data-feather="plus"></i></button>
          <button data-bs-toggle="modal" data-bs-target="#modal-delete-notula" class="btn btn-datatable btn-icon btn-danger ms-3"><i data-feather="trash-2"></i></button>
        <?php endif; ?>
      </div>
    </div>
    <!-- Rapat Biaya -->
    <?php if ($detail['jenis_rapat_biaya'] == '1') : ?>
      <div class="d-flex justify-content-between mb-3">
        <div>
          Tanda Terima Perlengkapan
        </div>
        <div class="d-flex">
          <a href="<?= base_url(); ?>/file/<?= $detail['id']; ?>/atk/Tanda Terima Perlengkapan <?= $detail['nama']; ?>.xls" class="badge bg-info text-white rounded-pill" download>Template ATK <i data-feather="download"></i></a>
          <div class="badge bg-danger text-white rounded-pill <?= $detail['atk'] ? "d-none" : " " ?> ms-3">Belum Tersedia</div>
          <!-- <button name="atk" class="btn btn-datatable atk btn-icon btn-primary <?= $detail['atk'] ? " " : "d-none" ?>"><i data-feather="eye"></i></button> -->
          <a href="/<?= $detail['atk']; ?>" class="btn btn-datatable btn-icon btn-success ms-3 <?= $detail['atk'] ? " " : "d-none" ?>" download><i data-feather="download"></i></a>
          <?php if (in_groups('admin') || in_groups('ketuatim') ||  $detail['notula_id'] == session()->get('id')) : ?>
            <button data-bs-toggle="modal" data-bs-target="#modal-add-atk" class="btn btn-datatable btn-icon btn-light ms-3"><i data-feather="plus"></i></button>
            <button data-bs-toggle="modal" data-bs-target="#modal-delete-atk" class="btn btn-datatable btn-icon btn-danger ms-3"><i data-feather="trash-2"></i></button>
          <?php endif; ?>
        </div>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <div>
          KAK
        </div>
        <div class="d-flex">
          <a href="<?= base_url(); ?>/file/template/Notulen Rapat Dinas.docx" class="badge bg-info text-white rounded-pill" download>Template KAK <i data-feather="download"></i></a>
          <div class="badge bg-danger text-white rounded-pill <?= $detail['kak'] ? "d-none" : " " ?> ms-3">Belum Tersedia</div>
          <!-- <button name="kak" class="btn btn-datatable kak btn-icon btn-primary <?= $detail['kak'] ? " " : "d-none" ?>"><i data-feather="eye"></i></button> -->
          <a href="/<?= $detail['kak']; ?>" class="btn btn-datatable btn-icon btn-success ms-3 <?= $detail['kak'] ? " " : "d-none" ?>" download><i data-feather="download"></i></a>
          <?php if (in_groups('admin') || in_groups('ketuatim') ||  $detail['notula_id'] == session()->get('id')) : ?>
            <button data-bs-toggle="modal" data-bs-target="#modal-add-kak" class="btn btn-datatable btn-icon btn-light ms-3"><i data-feather="plus"></i></button>
            <button data-bs-toggle="modal" data-bs-target="#modal-delete-kak" class="btn btn-datatable btn-icon btn-danger ms-3"><i data-feather="trash-2"></i></button>
          <?php endif; ?>
        </div>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <div>
          Transport
        </div>
        <div class="d-flex">
          <a href="<?= base_url(); ?>/file/<?= $detail['id']; ?>/transport/Bukti Penerimaan Uang <?= $detail['nama']; ?>.xls" class="badge bg-info text-white rounded-pill" download>Template Transport <i data-feather="download"></i></a>
          <div class="badge bg-danger text-white rounded-pill <?= $detail['transport'] ? "d-none" : " " ?> ms-3">Belum Tersedia</div>
          <!-- <button name="transport" class="btn btn-datatable transport btn-icon btn-primary <?= $detail['transport'] ? " " : "d-none" ?>"><i data-feather="eye"></i></button> -->
          <a href="/<?= $detail['transport']; ?>" class="btn btn-datatable btn-icon btn-success ms-3 <?= $detail['transport'] ? " " : "d-none" ?>" download><i data-feather="download"></i></a>
          <?php if (in_groups('admin') || in_groups('ketuatim') ||  $detail['notula_id'] == session()->get('id')) : ?>
            <button data-bs-toggle="modal" data-bs-target="#modal-add-transport" class="btn btn-datatable btn-icon btn-light ms-3"><i data-feather="plus"></i></button>
            <button data-bs-toggle="modal" data-bs-target="#modal-delete-transport" class="btn btn-datatable btn-icon btn-danger ms-3"><i data-feather="trash-2"></i></button>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- modal view link -->
<div id="modal-link" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mx-auto">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#00ac69;">
        <h5 class="modal-title" id="modal-title-link" style="color:white;">Link Dokumentasi <?= $detail['nama']; ?></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color:#00ac69; border:none;">
          <span aria-hidden="true"><i data-feather="x"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row holds-the-iframe">
          <a href="<?= $detail['dokum_link']; ?>"> <?= $detail['dokum_link']; ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal view notula -->
<div id="modal-notula" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-xl mx-auto">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#00ac69;">
        <h5 class="modal-title" id="modal-title-notula" style="color:white;">Notula <?= $detail['nama']; ?></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color:#00ac69; border:none;">
          <span aria-hidden="true"><i data-feather="x"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row holds-the-iframe">
          <iframe id="iframe-doc-notula" src="/<?= $detail['notula']; ?>" style="width:100%; height: 85vh" class="my-auto"></iframe>
          <!-- <object id="pdf_content" width="100%" height="1500px" type="application/pdf" trusted="yes" application="yes" title="Assembly" data="<?= base_url() ?>file/tes.pdf"> -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- surat undangan hadir -->
<div class="modal fade" id="modal-add-su" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Surat Undangan Rapat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('detail-rapat/upload/' . $detail['id']) ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pilih File:</label>
            <input type="file" name="surat_undangan_input" class="form-control" id="recipient-name">
          </div>
          <input class="btn btn-primary" type="submit" value="kirim">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- input daftar hadir -->
<div class="modal fade" id="modal-add-daftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Daftar Hadir Rapat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('detail-rapat/upload/' . $detail['id']) ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pilih File:</label>
            <input type="file" name="daftar_hadir_input" class="form-control" id="recipient-name">
          </div>
          <input class="btn btn-primary" type="submit" value="kirim">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- input atk -->
<div class="modal fade" id="modal-add-atk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload ATK Rapat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('detail-rapat/upload/' . $detail['id']) ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pilih File:</label>
            <input type="file" name="atk_input" class="form-control" accept="application/pdf" id="recipient-name">
          </div>
          <input class="btn btn-primary" type="submit" value="kirim">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- input link -->
<div class="modal fade" id="modal-add-link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Link Dokumentasi Rapat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('detail-rapat/upload/' . $detail['id']) ?>" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Masukkan Link Dokumentasi Gdrive:</label>
            <input type="url" name="link_input" class="form-control" id="recipient-name">
          </div>
          <input class="btn btn-primary" type="submit" value="kirim">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- input notula -->
<div class="modal fade" id="modal-add-notula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Notula Rapat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('detail-rapat/upload/' . $detail['id']) ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pilih File:</label>
            <input type="file" name="notula_input" accept="application/pdf" class="form-control" id="recipient-name">
          </div>
          <input class="btn btn-primary" type="submit" value="kirim">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- input KAK -->
<div class="modal fade" id="modal-add-kak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload KAK Rapat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('detail-rapat/upload/' . $detail['id']) ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pilih File:</label>
            <input type="file" name="kak_input" class="form-control" accept="application/pdf" id="recipient-name">
          </div>
          <input class="btn btn-primary" type="submit" value="kirim">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- input transport -->
<div class="modal fade" id="modal-add-transport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Transport Rapat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('detail-rapat/upload/' . $detail['id']) ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pilih File:</label>
            <input type="file" name="transport_input" class="form-control" accept="application/pdf" id="recipient-name">
          </div>
          <input class="btn btn-primary" type="submit" value="kirim">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete surat_undangan -->
<div class="modal fade" id="modal-delete-su" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p for="recipient-name text-center" class="col-form-label">Apakah anda yakin ingin menghapus surat undangan rapat <?= $detail['nama']; ?>?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary ms-3">Batal</button>
        <form action="<?= base_url('detail-rapat/delete/surat_undangan/' . $detail['id']) ?>" method="POST">
          <label class="btn btn-danger">
            Hapus <i data-feather="trash-2"></i>
            <input type="submit" class="d-none">
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete daftar hadir -->
<div class="modal fade" id="modal-delete-daftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p for="recipient-name text-center" class="col-form-label">Apakah anda yakin ingin menghapus daftar hadir rapat <?= $detail['nama']; ?>?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary ms-3">Batal</button>
        <form action="<?= base_url('detail-rapat/delete/daftar/' . $detail['id']) ?>" method="POST">
          <label class="btn btn-danger">
            Hapus <i data-feather="trash-2"></i>
            <input type="submit" class="d-none">
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete atk -->
<div class="modal fade" id="modal-delete-atk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p for="recipient-name text-center" class="col-form-label">Apakah anda yakin ingin menghapus ATK rapat <?= $detail['nama']; ?>?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary ms-3">Batal</button>
        <form action="<?= base_url('detail-rapat/delete/atk/' . $detail['id']) ?>" method="POST">
          <label class="btn btn-danger">
            Hapus <i data-feather="trash-2"></i>
            <input type="submit" class="d-none">
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete link -->
<div class="modal fade" id="modal-delete-link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p for="recipient-name text-center" class="col-form-label">Apakah anda yakin ingin menghapus link dokumentasi rapat <?= $detail['nama']; ?>?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary ms-3">Batal</button>
        <form action="<?= base_url('detail-rapat/delete/link/' . $detail['dokum_link']) ?>" method="POST">
          <label class="btn btn-danger">
            Hapus <i data-feather="trash-2"></i>
            <input type="submit" class="d-none">
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete notula -->
<div class="modal fade" id="modal-delete-notula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p for="recipient-name text-center" class="col-form-label">Apakah anda yakin ingin menghapus notula rapat <?= $detail['nama']; ?>?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary ms-3">Batal</button>
        <form action="<?= base_url('detail-rapat/delete/notula/' . $detail['id']) ?>" method="POST">
          <label class="btn btn-danger">
            Hapus <i data-feather="trash-2"></i>
            <input type="submit" class="d-none">
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete kak -->
<div class="modal fade" id="modal-delete-kak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p for="recipient-name text-center" class="col-form-label">Apakah anda yakin ingin menghapus KAK rapat <?= $detail['nama']; ?>?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary ms-3">Batal</button>
        <form action="<?= base_url('detail-rapat/delete/kak/' . $detail['id']) ?>" method="POST">
          <label class="btn btn-danger">
            Hapus <i data-feather="trash-2"></i>
            <input type="submit" class="d-none">
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete transport -->
<div class="modal fade" id="modal-delete-transport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p for="recipient-name text-center" class="col-form-label">Apakah anda yakin ingin menghapus Transport rapat <?= $detail['nama']; ?>?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary ms-3">Batal</button>
        <form action="<?= base_url('detail-rapat/delete/transport/' . $detail['id']) ?>" method="POST">
          <label class="btn btn-danger">
            Hapus <i data-feather="trash-2"></i>
            <input type="submit" class="d-none">
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- js -->
<script type="text/javascript">
  $('.notula').click(function() {
    // file = $(this).attr('data-file');
    // nama = $(this).attr('data-nama');
    // $("#iframe-doc").attr("src", "/file/tes.pdf");
    // $("#modal-title-notula").html('nama');
    $("#modal-notula").modal('show');
  });

  $('.daftar').click(function() {
    // file = $(this).attr('data-file');
    // nama = $(this).attr('data-nama');
    // $("#iframe-doc").attr("src", "<?= base_url() ?>/file/tes.pdf");
    // $("#iframe-doc-daftar").attr("src", "/file/tes.pdf");
    // $("#modal-title-daftar").html('nama');
    $("#modal-daftar").modal('show');
  });

  $('.undangan').click(function() {
    // file = $(this).attr('data-file');
    // nama = $(this).attr('data-nama');
    // $("#iframe-doc").attr("src", "<?= base_url() ?>/file/tes.pdf");
    // $("#iframe-doc-undangan").attr("src", "/file/tes.pdf");
    // $("#modal-title-undangan").html('nama');
    $("#modal-undangan").modal('show');
  });

  $('.link').click(function() {
    // file = $(this).attr('data-file');
    // nama = $(this).attr('data-nama');
    // $("#iframe-doc").attr("src", "<?= base_url() ?>/file/tes.pdf");
    // $("#iframe-doc-link").attr("src", "/file/tes.pdf");
    // $("#modal-title-link").html('nama');
    $("#modal-link").modal('show');
  });

  $('.atk').click(function() {
    // file = $(this).attr('data-file');
    // nama = $(this).attr('data-nama');
    // $("#iframe-doc").attr("src", "<?= base_url() ?>/file/tes.pdf");
    // $("#iframe-doc-atk").attr("src", "/file/tes.pdf");
    // $("#modal-title-atk").html('nama');
    $("#modal-atk").modal('show');
  });
</script>

<?php
$informasi = session()->getFlashdata('informasi');
if (!empty($informasi)) {
  echo $informasi;
}
?>

<?= $this->endSection(); ?>