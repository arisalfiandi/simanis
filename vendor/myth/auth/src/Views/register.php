<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Register - SIMANIS</title>
  <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png') ?>" />
  <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
      <div class="container-xl pt-5">
          <div class="row">
            <div class="col-sm-6 offset-sm-3">

              <div class="card">
                <h2 class="card-header"><?= lang('Auth.register') ?></h2>
                <div class="card-body">

                  <?= view('Myth\Auth\Views\_message_block') ?>

                  <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                      <label for="email"><?= lang('Auth.email') ?></label>
                      <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                      <!-- <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small> -->
                    </div>

                    <div class="form-group">
                      <label for="username">Nama Lengkap</label>
                      <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Nama Lengkap" value="<?= old('username') ?>">
                    </div>

                    <div class="form-group">
                      <label for="username">NIP</label>
                      <input type="text" class="form-control <?php if (session('errors.nip')) : ?>is-invalid<?php endif ?>" name="nip" placeholder="NIP" value="<?= old('nip') ?>">
                    </div>

                    <div class="form-group">
                      <label for="username">Pangkat</label>
                      <input type="text" class="form-control <?php if (session('errors.pangkat')) : ?>is-invalid<?php endif ?>" name="pangkat" placeholder="Pangkat" value="<?= old('pangkat') ?>">
                    </div>

                    <div class="form-group">
                      <label for="username">Jabatan</label>
                      <input type="text" class="form-control <?php if (session('errors.jabatan')) : ?>is-invalid<?php endif ?>" name="jabatan" placeholder="Jabatan" value="<?= old('jabatan') ?>">
                    </div>

                    <div class="form-group">
                      <label for="password"><?= lang('Auth.password') ?></label>
                      <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                      <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                  </form>


                  <hr>

                  <p><?= lang('Auth.alreadyRegistered') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
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
            <div class="col-md-6 small">Copyright &copy; BPS Batang</div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>