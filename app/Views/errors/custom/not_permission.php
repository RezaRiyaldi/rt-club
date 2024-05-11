<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="card border border-danger">
            <div class="card-body d-flex flex-column align-items-center gap-3">
                <span style="font-size: 5em;">⛔</span>
                <h1 class="text-center">Anda tidak diizinkan mengakses halaman ini!</h1>
                <a href="<?= base_url() ?>" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Halaman Utama</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>