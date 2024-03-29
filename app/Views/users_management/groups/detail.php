<?= $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header pb-0 border-bottom">
        <h6><?= $title ?></h6>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <table class="table table-sm">
                    <tr>
                        <th>Nama Grup</th>
                        <td>: <?= $group_name ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>: <?= $group_description ?? '-' ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <hr>

        <h5>Daftar User Grup <?= $group_name ?></h5>

        <div class="table-responsive pb-0">
            <table class="table" id="group-detail">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Fullname</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($list_user) > 0) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($list_user as $user) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->fullname ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    new DataTable($('#group-detail'))
</script>
<?= $this->endSection('script'); ?>