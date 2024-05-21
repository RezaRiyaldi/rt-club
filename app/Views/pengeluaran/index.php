<?= $this->extend('layout/base') ?>

<?= $this->section('content'); ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pengeluaran-tab" data-bs-toggle="tab" data-bs-target="#pengeluaran-tab-pane" type="button" role="tab" aria-controls="pengeluaran-tab-pane" aria-selected="true">Pengeluaran RT</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="pengeluaran-tab-pane" role="tabpanel" aria-labelledby="pengeluaran-tab" tabindex="0">
        <div class="card border" style="border-radius: 0; border-top: 0 !important">
            <div class="card-body">
                <div class="table-responsive pb-0">
                    <table class="table" id="pengeluaran-rt">
                        <thead>
                            <tr>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7" width="5%">No</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Pengeluaran</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7">Nominal</th>
                                <th class="text-secondary text-sm font-weight-bolder opacity-7" width="5%">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPengeluaran" tabindex="-1" aria-labelledby="modalPengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalPengeluaranLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="">Pengeluaran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pengeluaran" placeholder="Nama Pengeluaran">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="">Nominal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control number-input" name="nominal" placeholder="Jumlah nominal">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Periode <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="periode" value="<?= date('Y-m-d') ?>" placeholder="Nama Pengeluaran">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="">Deskripsi</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Note (Optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Pengeluaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus pengeluaran <span id="pengeluaranName" class="fw-bold"></span> dengan nominal <span id="pengeluaranAmount" class="fw-bold"></span>?</p>
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
    var pengeluaranRt = datatable({
        id: $("#pengeluaran-rt"),
        url: "<?= base_url() ?>pengeluaran/get_list",
        method: 'POST',
        columns: [{
                data: 'no',
                className: 'text-sm font-weight-bold text-center'
            },
            {
                data: 'pengeluaran',
                className: 'text-sm font-weight-bold'
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
                data: 'action',
                className: 'text-center'
            },
        ],
        defs: {
            targets: [0, 4],
            searchable: false,
            orderable: false
        },
        buttons: ['reload'],
        customButtons: [{
            text: "<i class='fas fa-plus'></i> Pengeluaran",
            action: function() {
                $("#modalPengeluaran").modal('show')
                $("#modalPengeluaranLabel").text('Tambah Pengeluaran')
                $("#modalPengeluaran form").attr('action', '/pengeluaran/add')
                $("#modalPengeluaran form input[type='text'], #modalPengeluaran form textarea").val('')
            },
            class: 'btn btn-sm btn-danger btn-add'
        }]
    })

    $('.number-input').keyup(function() {
        let input = $(this).val();

        let formattedInput = input.replace(/\D/g, '');
        if (formattedInput.length > 1 && formattedInput.charAt(0) === '0') {
            formattedInput = formattedInput.slice(1);
        }

        formattedInput = formattedInput.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $(this).val(formattedInput);
    });

    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id')

        $.ajax({
            url: '<?= base_url() ?>pengeluaran/edit/' + id,
            dataType: 'JSON',
            success: function(result) {
                $("#modalPengeluaran").modal('show')
                $("#modalPengeluaranLabel").text('Edit Pengeluaran')
                $("#modalPengeluaran form").attr('action', '/pengeluaran/edit/' + id)

                $("#modalPengeluaran input[name='pengeluaran']").val(result.pengeluaran)
                $("#modalPengeluaran input[name='nominal']").val(result.nominal)
                $("#modalPengeluaran input[name='periode']").val(result.periode)
                $("#modalPengeluaran textarea[name='description']").val(result.description)
            }
        })
    })


    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        var url = '<?= base_url() ?>pengeluaran/delete/' + id
        
        var pengeluaranName = $(this).data('name');
        var pengeluaranAmount = $(this).data('amount');

        $("#deleteModal").modal('show')
        $("#deleteModal form").attr('action', url);

        $("#pengeluaranName").text(pengeluaranName)
        $("#pengeluaranAmount").text(pengeluaranAmount)
    })
</script>

<?php if (!in_groups(['Superadmin', 'Ketua RT', 'Bendahara'])) : ?>
    <script>
        $(".btn-add").remove();
    </script>
<?php endif ?>
<?= $this->endSection('script'); ?>