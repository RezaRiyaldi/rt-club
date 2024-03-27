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
                    <table class="table align-items-center mb-0" id="users-management">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
                data: 'username',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'email',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'status',
                className: 'text-center'
            },
            {
                data: 'joined',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'action'
            },
        ],
        defs: {
            targets: [4],
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
</script>
<?= $this->endSection('script'); ?>