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
            <!-- <div class="card-header pb-0 border-bottom">
                <h6>Iuran Warga</h6>
            </div> -->
            <div class="card-body">
                <div class="table-responsive pb-0">
                    <table class="table" id="iuran-warga">
                        <thead>
                            <tr>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7" width="5%">No</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Tipe Iuran</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Nama Warga</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Metode Bayar</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7" width="5%">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div> -->
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
                className: 'text-sm font-weight-bold'
            },
            {
                data: 'date',
                className: 'text-sm font-weight-bold text-center'
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
                class: 'btn btn-sm btn-success'
            },
        ]
    })
</script>
<?= $this->endSection('script'); ?>