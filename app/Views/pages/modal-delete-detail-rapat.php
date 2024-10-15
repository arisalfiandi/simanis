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