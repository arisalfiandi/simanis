<?php $request = \Config\Services::request(); ?>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>
    <?= ($request->uri->getSegment(1) == "beranda" || $request->uri->getSegment(1) == '') ? 'Beranda' : 
    ($request->uri->getSegment(1) == "buat-undangan-rapat" ? 'Buat Undangan' :
    ($request->uri->getSegment(1) == "monitoring-rapat" ? 'Monitoring Rapat' :  
    ((($request->uri->getSegment(1) == "daftar-rapat") && ($request->uri->getSegment(2) != "detail")) ? 'Daftar Rapat' : 
    ((($request->uri->getSegment(1) == "daftar-rapat") && ($request->uri->getSegment(2) == "detail")) ? 'Detail Rapat' : 'Pegawai' ))))
    ?> 
    - SIMANIS</title>
  <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo_bps.png') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css" rel="stylesheet" />  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>