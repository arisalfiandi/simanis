<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\RapatModel;
use App\Models\UserModel;
use CodeIgniter\Files\File;
use CodeIgniter\I18n\Time;

class Rapat extends BaseController
{
  protected $rapat_model;

  public function tanggal_indo($tanggal, $cetak_hari = false)
  {
    $hari = array(
      1 =>    'Senin',
      'Selasa',
      'Rabu',
      'Kamis',
      'Jumat',
      'Sabtu',
      'Minggu'
    );

    $bulan = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $split     = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }

  public function buat_rapat()
  {    
    $user_model = new UserModel();
    $this->rapat_model = new RapatModel();
    helper(['form']);
    $validation = \Config\Services::validation();
    $rules = [
      'nama' => 'required',
      'tempat' => 'required',
      'tanggal' => 'required',
      'waktu_mulai' => 'required',
      'isBiaya' => 'required',
      'isMitra' => 'required',
      'isKepala' => 'required',
      'peserta' => 'required',
      'notula_id' => 'required',
      'dokum_id' => 'required',
    ];

    if (!$this->validate($rules)) {
      $errors = $validation->getErrors();
      foreach ($errors as $error) {
        $error = $error;
      }
      session()->setFlashdata('informasi', "<script>swal('GAGAL!','$error','error')</script>");
      return redirect()->to('/buat-undangan-rapat');
    } else {
      $isKepala = $this->request->getPost('isKepala');
      $nama_rapat = $this->request->getPost('nama');
      $tempat = $this->request->getPost('tempat');
      $tembusan = $this->request->getPost('tembusan');
      $tanggal = $this->request->getPost('tanggal');
      $waktu_mulai = $this->request->getPost('waktu_mulai');
      $waktu_akhir = $this->request->getPost('waktu_akhir');
      $peserta_arr = $this->request->getPost('peserta');
      array_unshift($peserta_arr, session()->get('id'));
      $data = [
        'nama' => $nama_rapat,
        'tempat' => $tempat,
        'tembusan' => $tembusan, //array
        'tanggal' => $tanggal,
        'waktu_mulai' => $waktu_mulai,
        'waktu_akhir' => $waktu_akhir,
        'jenis_rapat_biaya' => $this->request->getPost('isBiaya'),
        'jenis_rapat_mitra' => $this->request->getPost('isMitra'),
        'jumlah_mitra' => $this->request->getPost('jumlahMitra'),
        'peserta' => $peserta_arr, //array
        'notula_id' => $this->request->getPost('notula_id'),
        'dokum_id' => $this->request->getPost('dokum_id'),
        'created_id' => session()->get('id'),
      ];

      // dd($data);
      $data_rapat = $this->rapat_model->create_rapat($data);

      setlocale(LC_ALL, 'id_ID.utf8');

      // make excel surat undangan
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('file/template/Surat Undangan.xlsx');
      $worksheet = $spreadsheet->getActiveSheet();
      // tembusan
      for ($i = 1; $i < count($this->request->getPost('tembusan')); $i++) {
        $style_tembusan = $worksheet->getStyle('A12')->exportArray();
        $style_tembusanB = $worksheet->getStyle('B12')->exportArray();
        $worksheet->insertNewRowBefore(13);
        $nono = $i + 12;
        $worksheet->getStyle('A' . $nono)->applyFromArray($style_tembusan);
        $worksheet->getStyle('B' . $nono)->applyFromArray($style_tembusanB);
      }

      for ($i = 0; $i < count($this->request->getPost('tembusan')); $i++) {
        $no_tembusan = $i + 12;
        $no_urut_tembusan = $i + 1;
        $worksheet->getCell('A' . $no_tembusan)->setValue($no_urut_tembusan . '.');
        $worksheet->getCell('B' . $no_tembusan)->setValue($this->request->getPost('tembusan')[$i]);
      }
      // tanggal sekarang
      $hariIni = date('Y-m-d');
      $tanggal_now = $this->tanggal_indo($hariIni);
      $worksheet->getCell('H6')->setValue('Batang, ' . $tanggal_now);
      // nama rapat
      $no_nama = $no_tembusan + 5;
      $worksheet->getCell('B' . $no_nama)->setValue('Dalam rangka pelaksanaan ' . $nama_rapat . ', kami');
      // tanggal
      $tanggal_ind = $this->tanggal_indo($tanggal, true);
      $no_tangal = $no_nama + 3;
      $worksheet->getCell('D' . $no_tangal)->setValue(': ' . $tanggal_ind);
      // waktu 
      $waktu_mulai_date = date_create($this->request->getPost('waktu_mulai'));
      $waktu_mulai_str = date_format($waktu_mulai_date, 'H.i');
      $no_waktu = $no_nama + 4;
      if ($waktu_akhir) {
        $waktu_akhir_date = date_create($this->request->getPost('waktu_akhir'));
        $waktu_akhir_str = date_format($waktu_akhir_date, 'H.i');
        $worksheet->getCell('D' . $no_waktu)->setValue(': Pukul ' . $waktu_mulai_str . ' s/d ' . $waktu_akhir_str . ' WIB');
      } else {
        $worksheet->getCell('D' . $no_waktu)->setValue(': Pukul ' . $waktu_mulai_str . ' WIB s/d selesai');
      }
      // tempat
      $no_tempat = $no_nama + 5;
      $worksheet->getCell('D' . $no_tempat)->setValue(': ' . $tempat);
      // save excel su
      $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
      mkdir('file/' . $data_rapat['rapat_id'] . '/surat_undangan/', 0777, true);
      $writer->save('file/' . $data_rapat['rapat_id']  . '/surat_undangan/Surat Undangan ' . $data_rapat['nama'] . '.xls');


      // make excel daftar hadir
      $daftar_hadir = \PhpOffice\PhpSpreadsheet\IOFactory::load('file/template/Daftar Hadir.xlsx');
      $worksheet2 = $daftar_hadir->getActiveSheet();
      // ttd
      $worksheet2->getCell('G15')->setValue($this->request->getPost('selaku'));
      // nama ttd
      if($isKepala){
        $username = $user_model->get_user_nama(2);
      } else {
        $username = $user_model->get_user_nama($this->request->getPost('ttd_lainnya'));
      }
      $worksheet2->getCell('G18')->setValue($username[0]['username']);
      // nip ttd
      if($isKepala){
        $username = $user_model->get_user_nip(2);
      } else {
        $username = $user_model->get_user_nip($this->request->getPost('ttd_lainnya'));
      }
      $worksheet2->getCell('G19')->setValue('NIP. : '.$username[0]['nip']);
      // tanggal surat
      $worksheet2->getCell('G14')->setValue('Batang, ' . $tanggal_now);
      // nama
      $worksheet2->getCell('D3')->setValue($nama_rapat);
      // tanggal
      $tanggal_ind2 = $this->tanggal_indo($tanggal, true);
      $worksheet2->getCell('D4')->setValue($tanggal_ind2);
      // waktu 
      $waktu_mulai_date2 = date_create($this->request->getPost('waktu_mulai'));
      $waktu_mulai_str2 = date_format($waktu_mulai_date2, 'H.i');
      if ($waktu_akhir) {
        $waktu_akhir_date2 = date_create($this->request->getPost('waktu_akhir'));
        $waktu_akhir_str2 = date_format($waktu_akhir_date2, 'H.i');
        $worksheet2->getCell('D5')->setValue($waktu_mulai_str2 . ' s/d ' . $waktu_akhir_str2 . ' WIB');
      } else {
        $worksheet2->getCell('D5')->setValue($waktu_mulai_str2 . ' WIB s/d selesai');
      }
      // tempat
      $worksheet2->getCell('D6')->setValue($tempat);
      // daftar peserta
      $total_peserta = count($peserta_arr);
      $total_peserta += (int)$this->request->getPost('jumlahMitra');

      for ($i = 1; $i < $total_peserta; $i++) {
        $style_peserta = $worksheet2->getStyle('A11')->exportArray();
        $style_pesertaB = $worksheet2->getStyle('B11')->exportArray();
        $style_pesertaC = $worksheet2->getStyle('C11')->exportArray();
        $style_pesertaD = $worksheet2->getStyle('D11')->exportArray();
        $style_pesertaE = $worksheet2->getStyle('E11')->exportArray();
        $style_pesertaF = $worksheet2->getStyle('F11')->exportArray();
        $style_pesertaG = $worksheet2->getStyle('G11')->exportArray();
        $style_pesertaH = $worksheet2->getStyle('H11')->exportArray();
        $style_pesertaI = $worksheet2->getStyle('I11')->exportArray();
        $worksheet2->insertNewRowBefore(12);
        $nono = $i + 11;
        $worksheet2->getStyle('A' . $nono)->applyFromArray($style_peserta);
        $worksheet2->getStyle('B' . $nono)->applyFromArray($style_pesertaB);
        $worksheet2->getStyle('C' . $nono)->applyFromArray($style_pesertaC);
        $worksheet2->getStyle('D' . $nono)->applyFromArray($style_pesertaD);
        $worksheet2->getStyle('E' . $nono)->applyFromArray($style_pesertaE);
        $worksheet2->getStyle('F' . $nono)->applyFromArray($style_pesertaF);
        $worksheet2->getStyle('G' . $nono)->applyFromArray($style_pesertaG);
        $worksheet2->getStyle('H' . $nono)->applyFromArray($style_pesertaH);
        $worksheet2->getStyle('I' . $nono)->applyFromArray($style_pesertaI);
      }

      for ($i = 0; $i < $total_peserta; $i++) {
        $no_peserta2 = $i + 11;
        $no_urut_peserta2 = $i + 1;
        $worksheet2->getCell('A' . $no_peserta2)->setValue($no_urut_peserta2);
        if ($i % 2 != 0) {
          // $worksheet2->getCell('F' . $no_peserta2)->setValue($no_urut_peserta2);
          // $worksheet2->getCell('G' . $no_peserta2)->setValue($no_urut_peserta2);  
          $worksheet2->getCell('H' . $no_peserta2)->setValue($no_urut_peserta2);
          $worksheet2->getCell('I' . $no_peserta2)->setValue('......................');
        } else {
          $worksheet2->getCell('F' . $no_peserta2)->setValue($no_urut_peserta2);
          $worksheet2->getCell('G' . $no_peserta2)->setValue('......................');
        }
      }

      // nama peserta
      for ($i = 0; $i < count($peserta_arr); $i++) {
        $no_peserta2 = $i + 11;
        $username = $user_model->get_user_nama($peserta_arr[$i]);
        $worksheet2->getCell('B' . $no_peserta2)->setValue($username[0]['username']);
        $worksheet2->getCell('D' . $no_peserta2)->setValue($username[0]['jabatan']);
      }

      $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($daftar_hadir, 'Xls');
      mkdir('file/' . $data_rapat['rapat_id'] . '/daftar_hadir/', 0777, true);
      $writer->save('file/' . $data_rapat['rapat_id']  . '/daftar_hadir/Daftar Hadir ' . $data_rapat['nama'] . '.xls');

      // Jika Rapat Biaya
      if ($this->request->getPost('isBiaya') == '1') {
        // make excel atk
        $atk = \PhpOffice\PhpSpreadsheet\IOFactory::load('file/template/ATK.xlsx');
        $worksheet3 = $atk->getActiveSheet();
        // ttd
        $worksheet3->getCell('F16')->setValue($this->request->getPost('selaku'));
        // nama ttd
        if($isKepala){
          $username = $user_model->get_user_nama(2);
        } else {
          $username = $user_model->get_user_nama($this->request->getPost('ttd_lainnya'));
        }
          $worksheet3->getCell('F20')->setValue($username[0]['username']);
          // nip ttd
        if($isKepala){
          $username = $user_model->get_user_nip(2);
        } else {
          $username = $user_model->get_user_nip($this->request->getPost('ttd_lainnya'));
        }
        $worksheet3->getCell('F21')->setValue('NIP. : '.$username[0]['nip']);
        // tanggal surat
        $worksheet3->getCell('F15')->setValue('Batang, ' . $tanggal_now);
        // nama
        $worksheet3->getCell('D3')->setValue($nama_rapat);
        // tanggal
        $worksheet3->getCell('D4')->setValue($tanggal_ind2);
        // waktu 
        if ($waktu_akhir) {
          $worksheet3->getCell('D5')->setValue($waktu_mulai_str2 . ' s/d ' . $waktu_akhir_str2 . ' WIB');
        } else {
          $worksheet3->getCell('D5')->setValue($waktu_mulai_str2 . ' WIB s/d selesai');
        }
        // tempat
        $worksheet3->getCell('D6')->setValue($tempat);
        // tempat
        $worksheet3->getCell('D7')->setValue($this->request->getPost('perlengkapan_atk'));
        // daftar peserta
        $total_peserta = count($peserta_arr);
        $total_peserta += (int)$this->request->getPost('jumlahMitra');
        // copy format
        for ($i = 1; $i < $total_peserta; $i++) {
          $style_atk = $worksheet3->getStyle('A12')->exportArray();
          $style_atkB = $worksheet3->getStyle('B12')->exportArray();
          $style_atkC = $worksheet3->getStyle('C12')->exportArray();
          $style_atkD = $worksheet3->getStyle('D12')->exportArray();
          $style_atkE = $worksheet3->getStyle('E12')->exportArray();
          $style_atkF = $worksheet3->getStyle('F12')->exportArray();
          $style_atkG = $worksheet3->getStyle('G12')->exportArray();
          $style_atkH = $worksheet3->getStyle('H12')->exportArray();
          $worksheet3->insertNewRowBefore(13);
          $no_atk = $i + 12;
          $worksheet3->getStyle('A' . $no_atk)->applyFromArray($style_atk);
          $worksheet3->getStyle('B' . $no_atk)->applyFromArray($style_atkB);
          $worksheet3->getStyle('C' . $no_atk)->applyFromArray($style_atkC);
          $worksheet3->getStyle('D' . $no_atk)->applyFromArray($style_atkD);
          $worksheet3->getStyle('E' . $no_atk)->applyFromArray($style_atkE);
          $worksheet3->getStyle('F' . $no_atk)->applyFromArray($style_atkF);
          $worksheet3->getStyle('G' . $no_atk)->applyFromArray($style_atkG);
          $worksheet3->getStyle('H' . $no_atk)->applyFromArray($style_atkH);
        }

        for ($i = 0; $i < $total_peserta; $i++) {
          $no_peserta3 = $i + 12;
          $no_urut_peserta3 = $i + 1;
          $worksheet3->getCell('A' . $no_peserta3)->setValue($no_urut_peserta3);
          if ($i % 2 != 0) {
            // $worksheet3->getCell('F' . $no_peserta3)->setValue($no_urut_peserta3);
            // $worksheet3->getCell('G' . $no_peserta3)->setValue($no_urut_peserta3);  
            $worksheet3->getCell('G' . $no_peserta3)->setValue($no_urut_peserta3);
            $worksheet3->getCell('H' . $no_peserta3)->setValue('......................');
          } else {
            $worksheet3->getCell('E' . $no_peserta3)->setValue($no_urut_peserta3);
            $worksheet3->getCell('F' . $no_peserta3)->setValue('......................');
          }
        }

        for ($i = 0; $i < count($peserta_arr); $i++) {
          $no_peserta3 = $i + 12;
          $username = $user_model->get_user_nama($peserta_arr[$i]);
          $worksheet3->getCell('B' . $no_peserta3)->setValue($username[0]['username']);
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($atk, 'Xls');
        mkdir('file/' . $data_rapat['rapat_id'] . '/atk/', 0777, true);
        $writer->save('file/' . $data_rapat['rapat_id']  . '/atk/Tanda Terima Perlengkapan ' . $data_rapat['nama'] . '.xls');

        // make excel transport
        $transport = \PhpOffice\PhpSpreadsheet\IOFactory::load('file/template/Transport.xlsx');
        $worksheet4 = $transport->getActiveSheet();
        // tanggal surat
        $worksheet4->getCell('E13')->setValue( $tanggal_now);
        // tanggal surat bawah
        $worksheet4->getCell('J22')->setValue('Batang, ' . $tanggal_now);
        // tempat
        $worksheet4->getCell('E14')->setValue($tempat);
        // daftar peserta
        $total_peserta = count($peserta_arr);
        $total_peserta += (int)$this->request->getPost('jumlahMitra');
          // copy format
        for ($i = 1; $i < $total_peserta; $i++) {
          $style_transport = $worksheet4->getStyle('A18')->exportArray();
          $style_transportB = $worksheet4->getStyle('B18')->exportArray();
          $style_transportC = $worksheet4->getStyle('C18')->exportArray();
          $style_transportD = $worksheet4->getStyle('D18')->exportArray();
          $style_transportE = $worksheet4->getStyle('E18')->exportArray();
          $style_transportF = $worksheet4->getStyle('F18')->exportArray();
          $style_transportG = $worksheet4->getStyle('G18')->exportArray();
          $style_transportH = $worksheet4->getStyle('H18')->exportArray();
          $style_transportI = $worksheet4->getStyle('I18')->exportArray();
          $style_transportJ = $worksheet4->getStyle('J18')->exportArray();
          $style_transportK = $worksheet4->getStyle('K18')->exportArray();
          $style_transportL = $worksheet4->getStyle('L18')->exportArray();
          $worksheet4->insertNewRowBefore(19);
          $no_transport = $i + 18;
          $worksheet4->getStyle('A' . $no_transport)->applyFromArray($style_transport);
          $worksheet4->getStyle('B' . $no_transport)->applyFromArray($style_transportB);
          $worksheet4->getStyle('C' . $no_transport)->applyFromArray($style_transportC);
          $worksheet4->getStyle('D' . $no_transport)->applyFromArray($style_transportD);
          $worksheet4->getStyle('E' . $no_transport)->applyFromArray($style_transportE);
          $worksheet4->getStyle('F' . $no_transport)->applyFromArray($style_transportF);
          $worksheet4->getStyle('G' . $no_transport)->applyFromArray($style_transportG);
          $worksheet4->getStyle('H' . $no_transport)->applyFromArray($style_transportH);
          $worksheet4->getStyle('I' . $no_transport)->applyFromArray($style_transportI);
          $worksheet4->getStyle('J' . $no_transport)->applyFromArray($style_transportJ);
          $worksheet4->getStyle('K' . $no_transport)->applyFromArray($style_transportK);
          $worksheet4->getStyle('L' . $no_transport)->applyFromArray($style_transportL);
        }

        for ($i = 0; $i < $total_peserta; $i++) {
          $no_peserta3 = $i + 18;
          $no_urut_peserta3 = $i + 1;
          $worksheet4->getCell('A' . $no_peserta3)->setValue($no_urut_peserta3);
          if ($i % 2 != 0) {
            // $worksheet4->getCell('F' . $no_peserta3)->setValue($no_urut_peserta3);
            // $worksheet4->getCell('G' . $no_peserta3)->setValue($no_urut_peserta3);  
            $worksheet4->getCell('K' . $no_peserta3)->setValue($no_urut_peserta3);
            $worksheet4->getCell('L' . $no_peserta3)->setValue('......................');
          } else {
            $worksheet4->getCell('I' . $no_peserta3)->setValue($no_urut_peserta3);
            $worksheet4->getCell('J' . $no_peserta3)->setValue('......................');
          }
        }

        // for ($i = 0; $i < count($peserta_arr); $i++) {
        //   $no_peserta3 = $i + 11;
        //   $username = $user_model->get_user_nama($peserta_arr[$i]);
        //   $worksheet4->getCell('B' . $no_peserta3)->setValue($username[0]['username']);
        // }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($transport, 'Xls');
        mkdir('file/' . $data_rapat['rapat_id'] . '/transport/', 0777, true);
        $writer->save('file/' . $data_rapat['rapat_id']  . '/transport/Bukti Penerimaan Uang ' . $data_rapat['nama'] . '.xls');
      }

      //save pdf
      // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);
      // $writer->setPreCalculateFormulas(false);

      // $writer->save("file/coba.pdf");

      // send file to client
      // $file = basename($_GET['file']);
      // $filename = 'file/tes.pdf';
      // $content = file_get_contents($filename);
      // header("Content-Disposition: attachment; filename=" . $filename);

      // unlink($filename);
      // exit($content);

      //   session()->setFlashdata("file", "<script>
      //   var response = 'file/tes.pdf'
      //   var linkSource = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' + response;
      //   var downloadLink = document.createElement('a');
      //   var fileName = 'clients.' + format;

      //   downloadLink.href = linkSource;
      //   downloadLink.download = fileName;
      //   downloadLink.click();
      // </script>");


      session()->setFlashdata("informasi", "<script>Swal.fire(
        'Berhasil!',
        'Berhasil membuat rapat!',
        'success'
      )</script>");

      return redirect()->to('/daftar-rapat');
    }
  }

  public function hapus_rapat($id)
  {
    $rapat_model = new RapatModel();
    $rapat_model->delete_rapat($id);
    session()->setFlashdata("informasi", "<script>Swal.fire(
      'Berhasil!',
      'Berhasil menghapus rapat!',
      'success'
    )</script>");
    return redirect()->to('/daftar-rapat');
  }

  public function upload_file($id)
  {
    $rapat_model = new RapatModel();
    
    // upload surat undangan
    $surat_undangan = $this->request->getFile('surat_undangan_input');
    if ($surat_undangan) {
      $surat_undangan->move('file/' . $id . '/surat_undangan/');
      $filepath = 'file/' . $id . '/surat_undangan/' . $surat_undangan->getName();
      $rapat_model->upload_surat_undangan($id, $filepath);
      session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil mengupload daftar hadir rapat!',
           'success'
         )</script>");
      // $data = ['uploaded_fileinfo' => new File($filepath)];
      return redirect()->to('/daftar-rapat/detail/' . $id);
    }

    // upload daftar-hadir
    $daftar_hadir = $this->request->getFile('daftar_hadir_input');
    if ($daftar_hadir) {
      $daftar_hadir->move('file/' . $id . '/daftar_hadir/');
      $filepath = 'file/' . $id . '/daftar_hadir/' . $daftar_hadir->getName();
      $rapat_model->upload_daftar($id, $filepath);
      session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil mengupload daftar hadir rapat!',
           'success'
         )</script>");
      // $data = ['uploaded_fileinfo' => new File($filepath)];
      return redirect()->to('/daftar-rapat/detail/' . $id);
    }

    // upload atk
    $atk = $this->request->getFile('atk_input');
    if ($atk) {
      $atk->move('file/' . $id . '/atk/');
      $filepath = 'file/' . $id . '/atk/' . $atk->getName();
      $rapat_model->upload_atk($id, $filepath);
      session()->setFlashdata("informasi", "<script>Swal.fire(
            'Berhasil!',
            'Berhasil mengupload ATK rapat!',
            'success'
          )</script>");
      // $data = ['uploaded_fileinfo' => new File($filepath)];
      return redirect()->to('/daftar-rapat/detail/' . $id);
    }

    // upload link
    $link = $this->request->getVar('link_input');
    if ($link) {
      $rapat_model->upload_dokum_link($id, $link);
      session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil mengupload link dokumentasi rapat!',
           'success'
         )</script>");
      // $data = ['uploaded_fileinfo' => new File($filepath)];
      return redirect()->to('/daftar-rapat/detail/' . $id);
    }

    // upload notula
    $notula = $this->request->getFile('notula_input');
    if ($notula) {
      $notula->move('file/' . $id . '/notula/');
      $filepath = 'file/' . $id . '/notula/' . $notula->getName();
      $rapat_model->upload_notula($id, $filepath);
      session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil mengupload notula rapat!',
           'success'
         )</script>");
      // $data = ['uploaded_fileinfo' => new File($filepath)];
      return redirect()->to('/daftar-rapat/detail/' . $id);
    }
    
    // upload kak
    $kak = $this->request->getFile('kak_input');
    if ($kak) {
      $kak->move('file/' . $id . '/kak/');
      $filepath = 'file/' . $id . '/kak/' . $kak->getName();
      $rapat_model->upload_kak($id, $filepath);
      session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil mengupload daftar hadir rapat!',
           'success'
         )</script>");
      // $data = ['uploaded_fileinfo' => new File($filepath)];
      return redirect()->to('/daftar-rapat/detail/' . $id);
    }

    // upload transport
    $transport = $this->request->getFile('transport_input');
    if ($transport) {
      $transport->move('file/' . $id . '/transport/');
      $filepath = 'file/' . $id . '/transport/' . $transport->getName();
      $rapat_model->upload_transport($id, $filepath);
      session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil mengupload daftar hadir rapat!',
           'success'
         )</script>");
      // $data = ['uploaded_fileinfo' => new File($filepath)];
      return redirect()->to('/daftar-rapat/detail/' . $id);
    }

    // $data = ['errors' => 'The file has already been moved.'];
    session()->setFlashdata("informasi", "<script>Swal.fire(
      'Gagal!',
      'Gagal mengupload dokumen rapat!',
      'error'
    )</script>");
    return redirect()->to('/daftar-rapat/detail/' . $id);
  }

  public function hapus_notula($id)
  {
    $rapat_model = new RapatModel();
    $param = '0';
    $rapat_model->upload_notula($id, $param);
    session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil menghapus notula rapat!',
           'success'
         )</script>");
    // $data = ['uploaded_fileinfo' => new File($filepath)];
    return redirect()->to('/daftar-rapat/detail/' . $id);
    // return redirect()->to('/');
  }

  public function hapus_atk($id)
  {
    $rapat_model = new RapatModel();
    $param = '0';
    $rapat_model->upload_atk($id, $param);
    session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil menghapus atk rapat!',
           'success'
         )</script>");
    // $data = ['uploaded_fileinfo' => new File($filepath)];
    return redirect()->to('/daftar-rapat/detail/' . $id);
    // return redirect()->to('/');
  }

  public function hapus_daftar($id)
  {
    $rapat_model = new RapatModel();
    $param = '0';
    $rapat_model->upload_daftar($id, $param);
    session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil menghapus daftar hadir rapat!',
           'success'
         )</script>");
    // $data = ['uploaded_fileinfo' => new File($filepath)];
    return redirect()->to('/daftar-rapat/detail/' . $id);
    // return redirect()->to('/');
  }

  public function hapus_link($id)
  {
    $rapat_model = new RapatModel();
    $param = '0';
    $rapat_model->upload_dokum_link($id, $param);
    session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil menghapus link dokumentasi rapat!',
           'success'
         )</script>");
    // $data = ['uploaded_fileinfo' => new File($filepath)];
    return redirect()->to('/daftar-rapat/detail/' . $id);
    // return redirect()->to('/');
  }

  public function hapus_surat_undangan($id)
  {
    $rapat_model = new RapatModel();
    $param = '0';
    $rapat_model->upload_surat_undangan($id, $param);
    session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil menghapus link dokumentasi rapat!',
           'success'
         )</script>");
    // $data = ['uploaded_fileinfo' => new File($filepath)];
    return redirect()->to('/daftar-rapat/detail/' . $id);
    // return redirect()->to('/');
  }

  public function hapus_kak($id)
  {
    $rapat_model = new RapatModel();
    $param = '0';
    $rapat_model->upload_kak($id, $param);
    session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil menghapus link dokumentasi rapat!',
           'success'
         )</script>");
    // $data = ['uploaded_fileinfo' => new File($filepath)];
    return redirect()->to('/daftar-rapat/detail/' . $id);
    // return redirect()->to('/');
  }

  public function hapus_transport($id)
  {
    $rapat_model = new RapatModel();
    $param = '0';
    $rapat_model->upload_transport($id, $param);
    session()->setFlashdata("informasi", "<script>Swal.fire(
           'Berhasil!',
           'Berhasil menghapus link dokumentasi rapat!',
           'success'
         )</script>");
    // $data = ['uploaded_fileinfo' => new File($filepath)];
    return redirect()->to('/daftar-rapat/detail/' . $id);
    // return redirect()->to('/');
  }
}
