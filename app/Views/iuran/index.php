<?= $this->extend('layout/base') ?>

<?= $this->section('content'); ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="iuranWarga-tab" data-bs-toggle="tab" data-bs-target="#iuranWarga-tab-pane" type="button" role="tab" aria-controls="iuranWarga-tab-pane" aria-selected="true">Iuran Warga</button>
    </li>
    <!-- <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
    </li> -->
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="iuranWarga-tab-pane" role="tabpanel" aria-labelledby="iuranWarga-tab" tabindex="0">
        <div class="card border" style="border-radius: 0; border-top: 0 !important">
            <div class="card-body">
                <div class="table-responsive pb-0">
                    <table class="table" id="iuran-warga">
                        <thead>
                            <tr>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7" width="5%">No</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Tipe Iuran</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Nama Warga</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Metode Bayar</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Periode</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Nominal</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Status</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7" width="5%">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Iuran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data iuran <span id="userFullname" class="fw-bold"></span> dengan nominal <span id="iuranAmount" class="fw-bold"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary my-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger my-auto">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    var iuranWarga = datatable({
        id: $("#iuran-warga"),
        url: "<?= base_url() ?>iuran/get_list",
        method: 'POST',
        columns: [{
                data: 'no',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'type',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'fullname',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'payment_method',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'periode',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'nominal',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'status_kas',
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'action',
                className: 'text-center'

            },
        ],
        defs: {
            targets: [0, 5],
            searchable: false,
            orderable: false
        },
        buttons: ['reload'],
        customButtons: [
            {
                text: "<i class='fas fa-plus'></i> Iuran",
                action: function() {
                    window.location.href = "<?= base_url() ?>iuran/add";
                },
                class: 'btn btn-sm btn-success btn-add'
            },
            {
                text: "<i class='fas fa-plus'></i> Tipe Iuran",
                action: function() {
                    window.location.href = "<?= base_url() ?>iuran/type";
                },
                class: 'btn btn-sm btn-secondary btn-add-type'
            },
        ]
    })

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        var url = '<?= base_url() ?>iuran/delete/' + id

        var userFullname = $(this).data('name');
        var iuranAmount = $(this).data('amount');

        $("#deleteModal").modal('show')
        $("#deleteModal form").attr('action', url);

        $("#userFullname").text(userFullname)
        $("#iuranAmount").text(iuranAmount)
    })
</script>

<?php if (!in_groups(['Superadmin', 'Ketua RT', 'Bendahara', 'Sekretaris'])) : ?>
    <script>
        $(".btn-add, .btn-add-type").remove();
    </script>
<?php endif ?>
<?= $this->endSection('script'); ?>