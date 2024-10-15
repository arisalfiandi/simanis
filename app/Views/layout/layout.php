<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body class="nav-fixed">
  <?php include('nav.php'); ?>
  <div id="layoutSidenav">
    <?php include('sidenav.php'); ?>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-xl px-4 py-4">
          <?php $this->renderSection('content'); ?>
        </div>
      </main>
      <?php include('footer.php'); ?>
    </div>
  </div>
  <?php include('js.php'); ?>
</body>

</html>