<?php $request = \Config\Services::request(); ?>
<nav class="topnav shadow navbar navbar-expand justify-content-between justify-content-sm-start navbar-dark .bg-white" id="sidenavAccordion">
  <!-- Sidenav Toggle Button-->
  <button class="btn btn-icon order-1 order-lg-0 me-2 ms-lg-2 me-lg-0 navbar-brand" id="sidebarToggle"><i data-feather="menu"></i></button>
  <!-- Navbar Brand-->
  <!-- * * Tip * * You can use text or an image for your navbar brand.-->
  <!-- * * * * * * When using an image, we recommend the SVG format.-->
  <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
  <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">SIMANIS</a>
  <!-- Navbar Search Input-->
  <!-- * * Note: * * Visible only on and above the lg breakpoint-->
  <form class="form-inline me-auto d-none d-lg-block me-3" action="" autocomplete="off" method="get" id="myForm">
    <div class="input-group input-group-joined input-group-solid">
      <input class="form-control pe-0 key <?= (($request->uri->getSegment(1) == "daftar-rapat") && ($request->uri->getSegment(2) != "detail")) ? "" : "d-none" ?>" id="search" name="search" type="search" placeholder="Cari" aria-label="Search" value="<?= $request->getGet('search') ?>" />
      <div class="input-group-text <?= (($request->uri->getSegment(1) == "daftar-rapat") && ($request->uri->getSegment(2) != "detail")) ? "" : "d-none" ?>">
        <label>
          <i data-feather="search"></i>
          <input type="submit" class="d-none submit">
        </label>
      </div>
    </div>
  </form>
  <!-- Navbar Items-->
  <ul class="navbar-nav align-items-center ms-auto">
    <!-- User Dropdown-->
    <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
      <a class="btn btn-icon dropdown-toggle navbar-brand" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i style="font-size: 20px;" data-feather="user"></i></a>
      <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
        <h6 class="dropdown-header d-flex align-items-center">
          <i data-feather="user"></i>
          <div class="dropdown-user-details ms-2">
            <?php
            use App\Models\UserModel;
            $user_model = new UserModel();
            $arrayUser = $user_model->get_user_nama(session()->get('id'))
            ?>
            <div class="dropdown-user-details-name"><?php if($arrayUser) echo $arrayUser[0]['username'] ?></div>
          </div>
        </h6>
        <div class="dropdown-divider"></div>
        <!-- <a class="dropdown-item" href="#!">
          <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
          Profil
        </a> -->
        <a class="dropdown-item" href="<?= base_url() ?>/logout">
          <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
          Keluar
        </a>
      </div>
    </li>
  </ul>
</nav>

<!-- <script type="text/javascript">
  $(document).ready(function() {
    $(".key").on("input", function() {
      $("#myForm").submit();
    });
  });
</script> -->