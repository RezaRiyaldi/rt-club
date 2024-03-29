<?= $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Groups Management</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive pb-0">
                    <table class="table table-hover table-striped" id="group-management">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weigth-bolder" width='10%'>No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weigth-bolder">Nama Grup</th>
                                <th class="text-uppercase text-secondary text-xxs font-weigth-bolder">#</th>
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
        id: $("#group-management"),
        url: "<?= base_url() ?>groups-man/get_list",
        method: 'POST',
        columns: [
            {
                data: 'no',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'name',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'action'
            },
        ],
        defs: {
            targets: [0,2],
            searchable: false,
            orderable: false
        },
        buttons: ['reload'],
        customButtons: [{
            text: "<i class='fas fa-plus'></i> Group",
            action: function() {
                window.location.href = "<?= base_url() ?>groups-man/add";
            },
            class: 'btn btn-sm btn-success'
        }, ]
    })
</script>
<?= $this->endSection('script'); ?>