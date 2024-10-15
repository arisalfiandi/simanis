<?php $request = \Config\Services::request(); ?>
<div id="layoutSidenav_nav">
  <nav class="sidenav shadow-right sidenav-light ">
    <div class="sidenav-menu">
      <div class="nav accordion" id="accordionSidenav">
        <!-- Sidenav Menu Heading (Core)-->
        <div class="sidenav-menu-heading">Dasar</div>
        <!-- Sidenav Accordion (Dashboard)-->
        <a class="nav-link <?= ($request->uri->getSegment(1) === "beranda" || $request->uri->getSegment(1) == '') ? "active" : "" ?>" href="<?= base_url() ?>/">
          <div class="nav-link-icon"><i data-feather="home"></i></div>
          Beranda
        </a>

        <!-- Sidenav Administrasi (App Views)-->
        <div class="sidenav-menu-heading">Administrasi</div>
        <!-- Sidenav Accordion (Pages)-->
        <?php if (in_groups('admin') || in_groups('ketuatim')): ?>
        <a class="nav-link <?= $request->uri->getSegment(1) == "buat-undangan-rapat" ? "active" : "" ?>" href="<?= base_url() ?>/buat-undangan-rapat">
          <div class="nav-link-icon"><i data-feather="plus"></i></div>
          Buat Undangan Rapat
        </a>
        <?php endif; ?>
        <!-- Sidenav Accordion (Flows)-->
        <a class="nav-link <?= $request->uri->getSegment(1) == "daftar-rapat" ? "active" : "" ?>" href="<?= base_url() ?>/daftar-rapat">
          <div class="nav-link-icon"><i data-feather="grid"></i></div>
          Daftar Rapat
        </a>
        <!-- Sidenav Accordion (Flows)-->
        <!-- <a class="nav-link" href="<?= base_url() ?>/sop">
          <div class="nav-link-icon"><i data-feather="book-open"></i></div>
          SOP
        </a> -->

        <!-- Sidenav Monitoring-->
        <?php if (in_groups('admin') || in_groups('ketuatim')): ?>
        <div class="sidenav-menu-heading">Monitoring</div>
        <!-- Sidenav Monitoring-->
        <a class="nav-link <?= $request->uri->getSegment(1) == "monitoring-rapat" ? "active" : "" ?>" href="<?= base_url() ?>/monitoring-rapat">
          <div class="nav-link-icon"><i data-feather="activity"></i></div>
          Monitoring Surat Rapat
        </a>
        <?php endif; ?>
        <?php if (in_groups('admin')): ?>
        <!-- Sidenav Pegawai-->
        <a class="nav-link <?= $request->uri->getSegment(1) == "pegawai" ? "active" : "" ?>" href="<?= base_url() ?>/pegawai">
          <div class="nav-link-icon"><i data-feather="list"></i></div>
          Pegawai
        </a>
        <?php endif; ?>
      </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
      <div class="sidenav-footer-content">
        <!-- <div class="sidenav-footer-subtitle">Masuk Sebagai:</div> -->
        <!-- <div class="sidenav-footer-title mt-4">Valerie Luna</div> -->
      </div>
    </div>
  </nav>
</div>