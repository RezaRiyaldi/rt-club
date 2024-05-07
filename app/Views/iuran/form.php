<?php $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-6">
        <div class="card">
            <form action="" method="post">
                <?= @csrf_field() ?>
                <input type="hidden" name="id" value="<?= isset($iuran) ? base64_encode($iuran->id) : '' ?>">

                <div class="card-header pb-0 border-bottom">
                    <h6><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="">Nama Warga <span class="text-danger">*</span></label>
                        <select name="warga_id" id="" class="form-select">
                            <option value="">-- Pilih Warga</option>
                            <?php foreach ($wargas as $warga) : ?>
                                <option value="<?= $warga->id ?>" <?= isset($iuran) && $warga->id == $iuran->warga_id ? "selected" : "" ?>><?= $warga->username . " - " . $warga->fullname ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="">Tipe Iuran <span class="text-danger">*</span></label>
                        <select name="type_id" id="" class="form-select">
                            <option value="">-- Pilih Tipe Iuran</option>
                            <?php foreach ($iuran_type as $type) : ?>
                                <option value="<?= $type->id ?>" <?= isset($iuran) && $iuran->type_id ? "selected" : "" ?>><?= $type->type ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="">Nominal <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="nominal" class="form-control number-input" placeholder="Nominal Bayar" value="<?= isset($iuran) ? number_format($iuran->nominal, 0, ',', '.') : '' ?>">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="">Periode Bayar <span class="text-danger">*</span></label>
                        <input type="date" name="periode" class="form-control" placeholder="Periode Bayar" value="<?= isset($iuran) ? date('Y-m-d', strtotime($iuran->periode)) : date('Y-m-d') ?>">
                    </div>
                    <div class="">
                        <label for="">Note</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Catatan (Optional)"><?= $iuran->description ?? '' ?></textarea>
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
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('.number-input').keyup(function() {
            // Mendapatkan nilai input
            let input = $(this).val();

            // Menghapus karakter selain angka
            let formattedInput = input.replace(/\D/g, '');

            // Menangani kasus di mana angka 0 di depan dihilangkan ketika angka lain dimasukkan
            if (formattedInput.length > 1 && formattedInput.charAt(0) === '0') {
                formattedInput = formattedInput.slice(1);
            }

            // Menambahkan titik sebagai pemisah ribuan
            formattedInput = formattedInput.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Menetapkan nilai input yang diformat kembali ke input
            $(this).val(formattedInput);
        });
    });
</script>
<?= $this->endSection('script'); ?>