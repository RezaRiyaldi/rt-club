<?= $this->extend('layout/base') ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header pb-0 border-bottom">
        <h6>Tipe Iuran</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive pb-0">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#iuranTypeModal" id="addTypeIuran">
                <i class="fas fa-plus"></i> Tipe
            </button>
            <table class="table table-bordered table-striped" id="tipe-iuran">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Tipe Iuran</th>
                        <th>Nominal Per Bulan</th>
                        <th>Deskripsi</th>
                        <th width="5%">#</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    foreach ($iuran_type as $type) :
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $type->type ?></td>
                            <td>Rp. <?= number_format($type->nominal, 2, ',', '.') ?></td>
                            <td><?= $type->description ?></td>
                            <td class="text-center">
                                <a href="javascript:;" class="btn btn-warning py-1 px-2 btn-edit-type" data-id="<?= base64_encode($type->id) ?>" data-bs-toggle="modal" data-bs-target="#iuranTypeModal" id="addTypeIuran"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="iuranTypeModal" tabindex="-1" aria-labelledby="iuranTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="iuranTypeModalLabel">Tambah Tipe Iuran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="">Tipe Iuran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="type" required id="inputType" placeholder="Nama Tipe Iuran">
                    </div>
                    <button type="button" class="btn btn-info btn-sm" id="addSubType"><i class="fas fa-plus"></i> Sub Tipe</button>
                    <div id="subType"></div>
                    <div class="mb-2">
                        <label for="">Nominal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control number-input" name="nominal" required id="inputNominal" placeholder="Nominal per bulan">
                    </div>
                    <div class="mb-2">
                        <label for="">Deskripsi</label>
                        <textarea name="description" id="inputDesc" cols="30" rows="4" class="form-control" placeholder="(Optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" id="btnSubmit"><i class="fas fa-check"></i> Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    $("#tipe-iuran").DataTable();

    $("#addTypeIuran").on('click', function() {
        $("#iuranTypeModal form").attr('action', '/iuran/type/add');
        $("#iuranTypeModalLabel").text('Tambah Tipe Iuran')
        $("#btnSubmit").addClass('btn-success')
        $("#btnSubmit").removeClass('btn-warning')

        $("#inputType").val('')
        $("#inputNominal").val('').attr('readonly', false);
        $("#inputDesc").val('')
        $("#subType").html('')
    })

    $(".btn-edit-type").on('click', function() {
        var id = $(this).data('id');

        $("#iuranTypeModal form").attr('action', '/iuran/type/edit/' + id);
        $("#iuranTypeModalLabel").text('Edit Tipe Iuran')
        $("#btnSubmit").addClass('btn-warning')
        $("#btnSubmit").removeClass('btn-success')

        $.ajax({
            url: '<?= base_url() ?>iuran/type/get-detail/',
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(result) {
                const iuranType = result.iuranType;
                const subTypes = result.subTypes;
                $("#inputType").val(iuranType.type)
                $("#inputNominal").val(iuranType.nominal)
                $("#inputDesc").val(iuranType.description)
                $("#subType").html('')

                if (subTypes.length > 0) {
                    $("#inputNominal").attr('readonly', true);
                    subTypes.forEach(subType => {
                        var subTypeHtml = `
                            <div class="card mb-2 border border-info">
                                <div class="card-body">
                                    <input type="hidden" name="sub[id][]" value="${subType.id}">
                                    <button class="btn btn-danger position-absolute m-auto px-2 py-1 remove-subtype" style="right: 30px;"><i class="fas fa-trash"></i></button>
                                    <div class="mb-2">
                                        <label for="">Sub Tipe Iuran <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="sub[type][]" required placeholder="Nama Sub Tipe Iuran" value="${subType.type}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Nominal <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm number-input" name="sub[nominal][]" required placeholder="Nominal per bulan" value="${subType.nominal}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Deskripsi</label>
                                        <textarea name="sub[description][]" id="inputDesc" cols="30" rows="2" class="form-control" placeholder="(Optional)">${subType.description}</textarea>
                                    </div>
                                </div>
                            </div>`;

                        $("#subType").append(subTypeHtml);
                    });
                }
            }
        })
    })

    $("#addSubType").on('click', function() {
        var subType = `
            <div class="card mb-2 border border-info">
                <div class="card-body">
                    <button class="btn btn-danger position-absolute m-auto px-2 py-1 remove-subtype" style="right: 30px;"><i class="fas fa-trash"></i></button>
                    <div class="mb-2">
                        <label for="">Sub Tipe Iuran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="sub[type][]" required placeholder="Nama Sub Tipe Iuran">
                    </div>
                    <div class="mb-2">
                        <label for="">Nominal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm number-input" name="sub[nominal][]" required placeholder="Nominal per bulan">
                    </div>
                    <div class="mb-2">
                        <label for="">Deskripsi</label>
                        <textarea name="sub[description][]" cols="30" rows="2" class="form-control" placeholder="(Optional)"></textarea>
                    </div>
                </div>
            </div>`;

        $("#subType").append(subType);
        $("#inputNominal").attr('readonly', true);
    });

    $(document).on('click', '.remove-subtype', function() {
        $(this).closest('.card').remove();
        if ($("#subType").children().length == 0) {
            $("#inputNominal").attr('readonly', false);
        }
    });

    $(document).on('keyup', "[name='sub[nominal][]']", function() {
        var nominal = 0;
        $("[name='sub[nominal][]']").each(function() {
            nominal += parseInt($(this).val().replace(/\./g, ''));            
        });

        const formatedNumber = numberFormat(nominal.toString());
        
        $("#inputNominal").val(formatedNumber);
    });
</script>
<?= $this->endSection('script'); ?>