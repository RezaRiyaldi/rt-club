<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h3>Detail Pengeluaran</h3>
        <table class="table">
            <tr>
                <th>Jenis Pengeluaran</th>
                <td>: <?= $pengeluaran->pengeluaran ?></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>: <?= $pengeluaran->description ?></td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td>: Rp. <?= number_format($pengeluaran->nominal, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>: <?= date('d F Y', strtotime($pengeluaran->periode)) ?></td>
            </tr>
            <tr>
                <th>Dibuat oleh</th>
                <td>: <?= $pengeluaran->fullname ?? '<span class="badge bg-secondary">UNKNOWN</span>' ?></td>
            </tr>
        </table>
    </div>
</div>
<?= $this->endSection('content') ?>