<!-- input surat undangan -->
<div class="modal fade" id="modal-add-daftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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