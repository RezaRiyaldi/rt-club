<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header border-bottom">
        <h4 class="mb-0">Setting Akun</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card border">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-2">
                                <label for="">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" placeholder="E-mail" value="<?= $user->email ?>">
                            </div>
                            <div class="mb-2">
                                <label for="">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $user->username ?>">
                            </div>

                            <div class="alert alert-warning py-2 mt-4 mb-1 text-white">
                                Isi password jika ingin merubahnya
                            </div>
                            <div class="mb-2">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password min:6 karakter">
                            </div>
                            <div class="mb-2">
                                <label for="">Re-password</label>
                                <input type="password" class="form-control" name="repassword" placeholder="Re-Password harus sama dengan password">
                            </div>

                            <button type="submit" class="btn btn-success mt-4 mb-0">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>