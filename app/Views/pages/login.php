<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login - SB Admin Pro</title>
  <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png') ?>" />
  <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container-xl px-4">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <!-- Basic login form-->
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                  <h3 class="fw-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <!-- Login form-->
                  <!-- <form action="<?= base_url('/login') ?>" method="POST"> -->
                  <form action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <!-- Form Group (email address)-->
                    <!-- <div class="mb-3">
                      <label class="small mb-1" for="inputEmailAddress">NIP</label>
                      <input class="form-control" id="nip" name="nip" type="text" placeholder="Masukkan NIP" />
                    </div> -->
                    <?php if ($config->validFields === ['email']) : ?>
                      <div class="form-group">
                        <label for="login"><?= lang('Auth.email') ?></label>
                        <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                        <div class="invalid-feedback">
                          <?= session('errors.login') ?>
                        </div>
                      </div>
                    <?php else : ?>
                      <div class="form-group">
                        <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                        <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                        <div class="invalid-feedback">
                          <?= session('errors.login') ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <!-- Form Group (password)-->
                    <!-- <div class="mb-3">
                      <label class="small mb-1" for="password">Password</label>
                      <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan kata sandi" />
                    </div> -->
                    <div class="form-group">
                      <label for="password"><?= lang('Auth.password') ?></label>
                      <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                      <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                      </div>
                    </div>
                    <!-- Form Group (remember password checkbox)-->
                    <!-- <div class="mb-3">
                      <div class="form-check">
                        <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" />
                        <label class="form-check-label" for="rememberPasswordCheck">Ingat saya?</label>
                      </div>
                    </div> -->
                    <?php if ($config->allowRemembering) : ?>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                          <?= lang('Auth.rememberMe') ?>
                        </label>
                      </div>
                    <?php endif; ?>
                    <!-- Form Group (login box)-->
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                      <button type="submit" class="btn btn-primary text-center px-5" href="dashboard-1.html">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div id="layoutAuthentication_footer">
      <footer class="footer-admin mt-auto footer-dark">
        <div class="container-xl px-4">
          <div class="row">
            <div class="col-md-6 small">Copyright &copy; Aris</div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>