<?php $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <form action="/settings-man" method="post">
        <div class="card-header pb-0 border-bottom">
            <h6>Settings</h6>
        </div>

        <div class="card-body">
            <div class="col-md-6">
                <div class="mb-2">
                    <label for="">Application Name</label>
                    <input type="text" class="form-control" name="application_name" value="<?= $settings['application_name'] ?? '' ?>">
                </div>

                <div class="mb-2">
                    <label for="">Nama Perum/Kampung</label>
                    <input type="text" class="form-control" name="perum_name" value="<?= $settings['perum_name'] ?? '' ?>" placeholder="Contoh: Perum. Kertamukti Sakti Residence / Kp. Pisang Batu">
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">RT</label>
                            <input type="text" class="form-control" name="perum_rt" value="<?= $settings['perum_rt'] ?? '' ?>" placeholder="Contoh: 2; 1,2; 1-4">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="">RW</label>
                            <input type="text" class="form-control" name="perum_rw" value="<?= $settings['perum_rw'] ?? '' ?>" placeholder="Contoh: 2; 1,2; 1-4">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="mb-2">
                            <label for="">Bloks</label>
                            <input type="text" class="form-control" name="perum_bloks" value="<?= $settings['perum_bloks'] ?? '' ?>" placeholder="Contoh: A; A,D; A-D; A,D-F">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-2">
                            <label for="">Nomor Blok</label>
                            <input type="text" class="form-control" name="perum_blok_number" value="<?= $settings['perum_blok_number'] ?? '' ?>" placeholder="Contoh: 1; 1,3; 1-3">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-2">
                            <label for="">Nomor Rumah</label>
                            <input type="text" class="form-control" name="perum_home_number" value="<?= $settings['perum_home_number'] ?? '' ?>" placeholder="Contoh: 1; 1,3; 1-3">
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="">Nominal Kas / Bulan</label>
                    <input type="text" class="form-control number-input" name="nominal_kas" value="<?= $settings['nominal_kas'] ?? '' ?>" placeholder="Contoh: Rp. 100.000">
                </div>
            </div>
        </div>

        <div class="card-footer border-top">
            <button type="submit" class="btn btn-success mb-0">Simpan</button>
        </div>
    </form>
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