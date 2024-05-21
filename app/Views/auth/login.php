<?= $this->extend('auth/base'); ?>

<?= $this->section('content'); ?>
<?php $app_name = service('setting')->getSetting('application_name'); ?>

<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
        <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">
                    <?= $app_name; ?> Apps
                </h3>
                <p class="mb-0">Masukan username dan password untuk masuk ke aplikasi</p>
            </div>
            <div class="card-body">
                <?= view('Myth\Auth\Views\_message_block') ?>

                <form role="form" action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
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
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($config->allowRemembering) : ?>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                            <label class="form-check-label" for="rememberMe"> <?= lang('Auth.rememberMe') ?>
                            </label>
                        </div>
                    <?php endif; ?>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Login</button>
                    </div>
                </form>
            </div>
            <!-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                </p>
            </div> -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('<?= base_url() ?>assets/img/curved-images/curved6.jpg')"></div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>