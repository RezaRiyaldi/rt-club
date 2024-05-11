<?= $this->extend('layout/base') ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header mb-0 border-bottom">
        <h4 class="m-0">Detail Warga</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <th>Nama Warga</th>
                        <td>: <?= $warga->fullname ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td style="white-space: wrap">: <?= json_decode($warga->address, true)['alamat'] ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-4 text-center">
                <h3 class="<?= $status == 'Lunas' ? 'bg-success' : 'bg-danger text-white' ?> d-inline px-2 rounded mx-auto"><?= $status ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header mb-0 border-bottom">
        <h4 class="m-0">Detail Iuran</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal Bayar</th>
                        <th>Metode Pembayaran</th>
                        <th class="text-start">Nominal</th>
                        <?php if (in_groups(['Superadmin', 'Ketua RT', 'Bendahara'])) : ?>
                            <th>#</th>
                        <?php endif ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $total = 0;
                    foreach ($iurans as $iuran) :
                        $total += $iuran->nominal;
                    ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= date('d F Y', strtotime($iuran->periode)) ?></td>
                            <td class="text-center"><?= $iuran->payment_method ?? 'CASH' ?></td>
                            <td>Rp. <?= number_format($iuran->nominal) ?></td>
                            <?php if (in_groups(['Superadmin', 'Ketua RT', 'Bendahara'])) : ?>
                                <td class="text-center">
                                    <a href="<?= base_url('iuran/edit/' . base64_encode($iuran->id)) ?>" class="btn btn-warning btn-sm px-2 py-1 me-1 mb-0" data-toggle="tooltip" title="Edit User"><i class="fas fa-pen"></i></a>
                                </td>
                            <?php endif ?>

                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr class="border">
                        <th colspan="3" class="text-center">Total</th>
                        <th colspan="2">Rp. <?= number_format($total) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>