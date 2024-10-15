<?= $this->extend('Views/layout/layout'); ?>

<?= $this->section('content') ?>
<div class="card">
  <div class="card-body">
    <div class="row align-items-center">
      <form method="POST" action="<?= base_url() ?>/buat-rapat" id="buat-rapat">
        <!-- nama rapat -->
        <div class="mb-3">
          <h6>Nama Rapat</h6><input class="form-control form-control-solid" id="nama" name="nama" type="text" placeholder="Masukkan nama rapat..." required>
        </div>
        <!-- tempat rapat -->
        <div class="mb-3">
          <h6>Tempat Rapat</h6><input class="form-control form-control-solid" id="tempat" name="tempat" type="text" placeholder="Masukkan tempat rapat..." required>
        </div>
        <!-- tembusan rapat -->
        <div class="mb-3">
          <h6>Tembusan Rapat</h6>
          <input class="form-control form-control-solid mb-2" id="tembusan" name="tembusan[]" type="text" placeholder="Masukkan tembusan rapat..." required>
          <input class="form-control form-control-solid mb-2 d-none" id="tembusan2" name="" type="text" placeholder="Masukkan tembusan rapat...">
          <input class="form-control form-control-solid mb-2 d-none" id="tembusan3" name="" type="text" placeholder="Masukkan tembusan rapat...">
          <input class="form-control form-control-solid mb-2 d-none" id="tembusan4" name="" type="text" placeholder="Masukkan tembusan rapat...">
          <input class="form-control form-control-solid mb-2 d-none" id="tembusan5" name="" type="text" placeholder="Masukkan tembusan rapat...">
          <input class="form-control form-control-solid mb-2 d-none" id="tembusan6" name="" type="text" placeholder="Masukkan tembusan rapat...">
          <input class="form-control form-control-solid mb-2 d-none" id="tembusan7" name="" type="text" placeholder="Masukkan tembusan rapat...">
          <a href="" class="text-end text-decoration-underline fs-6" id="tambahtembusan" class=""><i data-feather="plus"></i> Tambah Tembusan</a>
        </div>
        <!-- tanggal rapat -->
        <div class="mt-4">
          <h6>Tanggal Rapat</h6>
        </div>
        <div class="input-group input-group-joined mb-3" style="width: 16.5rem;">
          <span class="input-group-text">
            <i data-feather="calendar"></i>
          </span>
          <input class="form-control ps-0" id="tanggal" name="tanggal" type="date" placeholder="Pilih tanggal rapat..." required/>
        </div>
        <div class="d-flex justify-content-start">
          <!-- waktu mulai rapat -->
          <div class=" mt-1">
            <h6>Waktu Mulai Rapat</h6><input class="form-control form-control-solid" id="tempat" name="waktu_mulai" type="time" placeholder="Masukkan waktu mulai rapat..." required>
          </div>
          <!-- waktu akhir rapat -->
          <div class=" mt-1 ms-5">
            <h6>Waktu Akhir Rapat (kosongkan jika s/d selesai)</h6><input class="form-control form-control-solid" id="tempat" name="waktu_akhir" type="time" placeholder="Masukkan waktu akhir  rapat...">
          </div>
        </div>
        <!-- jenis rapat -->
        <div class="mt-4">
          <h6>Jenis Rapat</h6>
        </div>
        <div class="form-check form-check-solid">
          <input class="form-check-input" id="isBiayaNo" type="radio" name="isBiaya" checked value="0">
          <label class="form-check-label" for="isBiayaNo">Tanpa Biaya</label>
        </div>
        <div class="form-check form-check-solid">
          <input class="form-check-input" id="isBiayaYes" type="radio" name="isBiaya" value="1">
          <label class="form-check-label" for="isBiayaYes">Dengan Biaya</label>
        </div>
        
        <!-- Jenis Perlengkapan ATK -->
        <div id="jenisPerlengkapan" class="mt-4 d-none">
          <h6>Jenis Perlengkapan ATK</h6><input class="form-control form-control-solid" name="perlengkapan_atk" id="jenisPerlengkapanInput" type="text" placeholder="Misal: Blocknote, Pensil mekanik, dll ...">
        </div>

        <!-- Jenis peserta rapat -->
        <div class="mt-4">
          <h6>Jenis Peserta Rapat</h6>
        </div>
        <div class="form-check form-check-solid">
          <input class="form-check-input" id="isMitraYes" type="radio" name="isMitra">
          <label class="form-check-label" for="isMitraYes">Dengan Mitra</label>
        </div>
        <div class="form-check form-check-solid">
          <input class="form-check-input" id="isMitraNo" type="radio" name="isMitra" checked>
          <label class="form-check-label" for="isMitraNo">Tanpa Mitra</label>
        </div>

        <!-- Jumlah mitra -->
        <div id="jumlahMitra" class="mt-4">
          <h6>Jumlah Mitra</h6><input class="form-control form-control-solid" name="jumlahMitra" id="jumlahMitraInput" type="number" placeholder="Masukkan jumlah mitra...">
        </div>

        <!-- daftar peserta -->
        <div class="mt-4">
          <h6>Daftar Peserta Rapat</h6>
        </div>
        <div class="form-check">
          <table id="tableID">
            <?php if (!empty($userNotId)) :
              foreach ($userNotId as $data) : ?>
                <tr>
                  <td>
                    <div class="form-check"> <input class="form-check-input cb_row" name="peserta[]" id="flexCheckDefault<?= $data['id']; ?>" type="checkbox" value="<?= $data['id']; ?>">
                      <label class="form-check-label" for="flexCheckDefault<?= $data['id']; ?>"><?= $data['username']; ?></label>
                    </div>
                  </td>
                </tr>
            <?php endforeach;
            endif; ?>
          </table>
          <div class="form-check">
            <input type="checkbox" class="form-check-input cb_all" id="cb_all">
            <label class="form-check-label" for="cb_all">Pilih semua</label>
          </div>
        </div>

        <!-- notula -->
        <div class="mt-4">
          <h6>Notula Rapat</h6>
        </div>
        <div class="form-check">
          <!-- <?php
                // var_dump($rapat);
                if (!empty($user)) {
                  foreach ($user as $data) {
                    echo '<div class="form-check"><input class="form-check-input" name="notula_id" id="flexCheckDefault" type="radio" value="' . $data['id'] . '">
            <label class="form-check-label" for="flexCheckDefault">' . $data['username'] . '</label> <br></div>';
                  };
                }
                ?> -->
          <?php if (!empty($user)) :
            foreach ($user as $data) : ?>
              <tr>
                <td>
                  <div class="form-check"> <input class="form-check-input" name="notula_id" id="flexCheckDefaultNotula<?= $data['id']; ?>" type="radio" value="<?= $data['id']; ?>">
                    <label class="form-check-label" for="flexCheckDefaultNotula<?= $data['id']; ?>"><?= $data['username']; ?></label>
                  </div>
                </td>
              </tr>
          <?php endforeach;
          endif; ?>
        </div>

        <script>
          <a href="" download class="d-none"></a>
        </script>

        <!-- dokumenter -->
        <div class="mt-4">
          <h6>Dokumenter Rapat</h6>
        </div>
        <div class="form-check">
          <?php if (!empty($user)) :
            foreach ($user as $data) : ?>
              <tr>
                <td>
                  <div class="form-check"> <input class="form-check-input" name="dokum_id" id="flexCheckDefaultDokum<?= $data['id']; ?>" type="radio" value="<?= $data['id']; ?>">
                    <label class="form-check-label" for="flexCheckDefaultDokum<?= $data['id']; ?>"><?= $data['username']; ?></label>
                  </div>
                </td>
              </tr>
          <?php endforeach;
          endif; ?>
        </div>
        <!-- <div class="form-check">
          <input class="form-check-input" id="flexCheckChecked" type="checkbox" value="">
          <label class="form-check-label" for="flexCheckChecked">Checked checkbox</label>
        </div> -->

         <!--  Penandatangan rapat -->
         <div class="mt-4">
          <h6> Penandatangan Daftar Hadir Rapat</h6>
        </div>
        <div class="form-check form-check-solid">
          <input class="form-check-input" id="isKepalaYes" type="radio" name="isKepala" checked>
          <label class="form-check-label" for="isKepalaYes">Kepala BPS Kab. Batang</label>
        </div>
        <div class="form-check form-check-solid">
          <input class="form-check-input" id="isKepalaNo" type="radio" name="isKepala">
          <label class="form-check-label" for="isKepalaNo">Lainnya</label>
        </div>

        <!-- penandatangan lainnya -->
        <div class="mt-4 ttd-lainnya d-none">
          <h6>Penandatangan Daftar Hadir Rapat</h6>
        </div>
        <div class="form-check ttd-lainnya d-none">
          <?php if (!empty($user)) :
            foreach ($user as $data) : ?>
              <tr>
                <td>
                  <div class="form-check"> <input class="form-check-input" name="ttd_lainnya" id="flexCheckDefaultTTD<?= $data['id']; ?>" type="radio" value="<?= $data['id']; ?>">
                    <label class="form-check-label" for="flexCheckDefaultTTD<?= $data['id']; ?>"><?= $data['username']; ?></label>
                  </div>
                </td>
              </tr>
          <?php endforeach;
          endif; ?>
        </div>

        <!-- Jumlah mitra -->
        <div id="jumlahMitra" class="ttd-lainnya d-none mt-4">
          <h6>Selaku:</h6><input class="form-control form-control-solid" name="selaku" id="selakuInput" type="text" placeholder="Misal: Ketua TIM A atau penyelenggara...">
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary rounded mt-4 text-end">Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.cb_all').click(function() {
      $('.cb_row').prop('checked', this.checked);
    });
    var i = 2
    $('#tambahtembusan').click(function(e){
      e.preventDefault()
      $('#tembusan'+i).removeClass('d-none');
      $('#tembusan'+i).attr('name', 'tembusan[]');
      i++
    });
    // is ttd kepala
    $('#isKepalaNo').click(function(){
      $('.ttd-lainnya').removeClass('d-none');
      $('#selakuInput').prop('required',true);
    })
    $('#isKepalaYes').click(function(){
      $('.ttd-lainnya').addClass('d-none');
      $('#selakuInput').prop('required',false);
    })
    // is biaya
    $('#isBiayaYes').click(function(){
      $('#jenisPerlengkapan').removeClass('d-none');
      $('#jenisPerlengkapanInput').prop('required',true);
    })
    $('#isBiayaNo').click(function(){
      $('#jenisPerlengkapan').addClass('d-none');
      $('#jenisPerlengkapanInput').prop('required',false);
    })
    // is mitra
    $('#isMitraYes').click(function(){
      $('#jumlahMitraInput').prop('required',true);
    })
    $('#isMitraNo').click(function(){
      $('#jumlahMitraInput').prop('required',false);
    })
    // validation notula id dan dokum id
    var idsArr = [];
    $('input:checkbox:checked').each(function() {
        idsArr.push(this.value);
    });
    console.log(idsArr)
    // if( $.inArray(, idsArr) !== -1 ) {

    // }
  });
</script>

<?= $this->endSection(); ?>