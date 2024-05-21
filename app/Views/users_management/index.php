<?php $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Users Management</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-hover table-striped table-bordered" id="users-management">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="5%">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Rumah</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No HP</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                                <th class="text-secondary opacity-7">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="assignGroupModal" tabindex="-1" aria-labelledby="assignGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/groups-man/assign" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignGroupModalLabel">Grup</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="mb-2">
                        <label for="">Nama User</label>
                        <input type="text" readonly id="fullname" class="form-control">
                    </div>

                    <div>
                        <label for="">Grup</label>
                        <select name="group_id" id="" class="form-select" required>
                            <option value="">-- Pilih Grup</option>
                            <?php foreach ($groups as $group) : ?>
                                <option value="<?= $group->id ?>"> <?= $group->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/users-man/setting-account" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAccountModalLabel">Edit Akun</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" id="user_id_account" name="user_id_account">

                    <div class="mb-2">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="E-mail">
                    </div>
                    <div class="mb-2">
                        <label for="">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    var table = datatable({
        id: $("#users-management"),
        url: "<?= base_url() ?>users-man/get_list",
        method: 'POST',
        columns: [{
                data: 'no',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'username',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'no_rumah',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'fullname',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'no_hp',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'jabatan',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'joined',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'action',
                className: 'text-center'

            },
        ],
        defs: {
            targets: [5],
            searchable: false,
            orderable: false
        },
        buttons: ['reload'],
        customButtons: [{
            text: "<i class='fas fa-plus'></i> User",
            action: function() {
                window.location.href = "<?= base_url() ?>users-man/add";
            },
            class: 'btn btn-sm btn-success btn-add'
        }, ]
    })

    $(document).on('click', ".assign-group", function() {
        $("#assignGroupModal").modal('show');

        var id_user = $(this).data('id');
        var fullname = $(this).data('fullname');
        var username = $(this).data('username');

        $("#user_id").val(id_user);
        $("#fullname").val(fullname != "" ? fullname : username);
    })

    $(document).on('click', ".edit-account", function() {
        $("#editAccountModal").modal('show');

        var id_user = $(this).data('id');
        var email = $(this).data('email');
        var username = $(this).data('username');

        $("#user_id_account").val(id_user);
        $("#username").val(username);
        $("#email").val(email);
    })
</script>

<?php if (!in_groups(['Superadmin', 'Ketua RT'])) : ?>
    <script>
        $(".btn-add").remove();
    </script>
<?php endif ?>
<?= $this->endSection('script'); ?>