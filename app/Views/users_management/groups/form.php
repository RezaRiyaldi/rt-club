<?php $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-6">
        <div class="card">
            <form action="<?= $url ?>" method="post">
                <?= @csrf_field() ?>

                <div class="card-header pb-0 border-bottom">
                    <h6><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="">Nama Grup <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required placeholder="Nama Grup" value="<?= $group->name ?? '' ?>">
                    </div>
                    <div class="">
                        <label for="">Deskripsi Grup</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Deskripsi Grup (Optional)"><?= $group->description ?? '' ?></textarea>
                    </div>
                </div>
                <div class="card-footer border-top">
                    <button type="submit" class="btn btn-success mb-0"><i class="fas fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>