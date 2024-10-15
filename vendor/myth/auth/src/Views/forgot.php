<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Forgot - SIMANIS</title>
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
                <h2 class="card-header"><?= lang('Auth.forgotPassword') ?></h2>
                <div class="card-body">

                  <?= view('Myth\Auth\Views\_message_block') ?>

                  <p><?= lang('Auth.enterEmailForInstructions') ?></p>

                  <form action="<?= url_to('forgot') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                      <label for="email"><?= lang('Auth.emailAddress') ?></label>
                      <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">
                      <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                      </div>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.sendInstructions') ?></button>
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