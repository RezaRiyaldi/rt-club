<?= $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header text-center border-bottom">
        <h2>E - Kartu Keluarga</h2>
        <h4>No. <?= $no_kk ?></h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm">
                    <tr class="text-sm">
                        <th>Nama Kepala Keluarga</th>
                        <td>: <?= $lead_family->fullname ?></td>
                    </tr>
                    <tr class="text-sm">
                        <th>Email</th>
                        <td>: <?= $lead_family->email ?></td>
                    </tr>
                    <tr class="text-sm">
                        <th>Alamat</th>
                        <td>: <?= $lead_address->alamat ?></td>
                    </tr>
                    <tr class="text-sm">
                        <th>RT/RW</th>
                        <td>: <?= $lead_address->rt . " / " . $lead_address->rw ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table table-sm">
                    <tr class="text-sm">
                        <th>Desa / Kelurahan</th>
                        <td>: <?= $lead_address->kelurahan ?></td>
                    </tr>
                    <tr class="text-sm">
                        <th>Kecamatan</th>
                        <td>: <?= $lead_address->kecamatan ?></td>
                    </tr>
                    <tr class="text-sm">
                        <th>Kabupaten/Kota</th>
                        <td>: <?= $lead_address->kota ?></td>
                    </tr>
                    <tr class="text-sm">
                        <th>Provinsi</th>
                        <td>: <?= $lead_address->provinsi ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-sm text-sm table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th class="text-center">NIK</th>
                        <th>Status di Keluarga</th>
                        <th class="text-center">Jenis <br> Kelamin</th>
                        <th class="text-center">No. HP</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Status Perkawinan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($family as $fams) :
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $fams->fullname ?></td>
                            <td class="text-center"><?= $fams->no_ktp ?></td>
                            <td class="text-center"><?= $fams->status_family ?></td>
                            <td class="text-center"><?= $fams->gender ?></td>
                            <td class="text-center"><?= $fams->phone != "" ? $fams->phone : '-' ?></td>
                            <td><?= $fams->place_of_birth ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($fams->birth_of_day)) ?></td>
                            <td><?= $fams->religion ?></td>
                            <td><?= $fams->work != "" ? $fams->work : '<div class="text-center">-</div>' ?></td>
                            <td class="text-center"><?= $fams->marital_status ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-4 ">
                <table class="mx-auto table table-sm">
                    <tr>
                        <td>Dimasukan pada</td>
                        <td>: <span class="border"><?= date('d-m-Y', strtotime($lead_family->created_at)) ?></span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 ">
                <table class="mx-auto table-sm text-center">
                    <tr>
                        <td>Kepala Keluarga</td>
                    </tr>
                    <tr>
                        <td style="height: 60px;"></td>
                    </tr>
                    <tr>
                        <th class="font-weigth-bolder text-decoration-underline"><?= $lead_family->fullname ?></th>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 ">
                <table class="mx-auto table-sm text-center">
                    <tr>
                        <td>Ketua RT</td>
                    </tr>
                    <tr>
                        <td style="height: 60px;"></td>
                    </tr>
                    <tr>
                        <?php if (!empty($ketua_rt)) : ?>
                            <th class="font-weigth-bolder text-decoration-underline"><?= $ketua_rt ?></th>
                        <?php else : ?>
                            <td class="fst-italic">Belum ada Ketua RT</td>
                        <?php endif ?>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>