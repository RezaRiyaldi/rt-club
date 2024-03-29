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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
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
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    var table = datatable({
        id: $("#users-management"),
        url: "<?= base_url() ?>users-man/get_list",
        method: 'POST',
        columns: [
            {
                data: 'no',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'username',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'email',
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
            class: 'btn btn-sm btn-success'
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
</script>
<?= $this->endSection('script'); ?>