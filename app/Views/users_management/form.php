<?php $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col">
        <div class="card">
            <form action="<?= $url ?>" method="post">
                <?= csrf_field() ?>

                <div class="card-header pb-0 border-bottom">
                    <h6><?= $title ?></h6>
                </div>
                <div class="card-body" id="container-family">
                    <div class="row">
                        <div class="col-md-8 mx-auto d-block">
                            <div class="mb-3 text-center">
                                <label for="" class="text-lg">No. Kartu Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="no_kk" class="form-control" required placeholder="Nomor Kartu Keluarga">
                            </div>
                        </div>

                        <div id="head-family">
                            <hr>

                            <h4 class="text-center">Kepala Keluarga</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-2">
                                                <input type="hidden" name="id[]">
                                                <label for="">NIK <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="no_ktp[]" required placeholder="Nomor Induk Kependudukan">
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="mb-2">
                                                <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="fullname[]" required placeholder="Nama Lengkap Kepala Keluarga">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="place_of_birth[]" required placeholder="Tempat Lahir">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="birth_of_day[]" required placeholder="Tanggal Lahir">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio" name="gender[]" id="male" value="Laki - laki">
                                                        <label class="form-check-label" for="male">Laki - laki</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio" name="gender[]" id="female" value="Perempuan">
                                                        <label class="form-check-label" for="female">Perempuan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="">Status Perkawinan <span class="text-danger">*</span></label>

                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio" name="marital_status[]" id="married" value="Menikah">
                                                        <label class="form-check-label" for="married">Menikah</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio" name="marital_status[]" id="single" value="Belum Menikah">
                                                        <label class="form-check-label" for="single">Belum Menikah</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label for="">Agama <span class="text-danger">*</span></label>
                                                <select name="religion[]" id="religion" class="form-select" required>
                                                    <option value="">-- Pilih Agama</option>
                                                    <option value="Islam" selected>Islam</option>
                                                    <option value="Protestan">Protestan</option>
                                                    <option value="Katholik">Katholik</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Khonghucu">Khonghucu</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-2">
                                                <label for="">Golongan Darah</label>
                                                <select name="blood_group[]" id="blood_group" class="form-select">
                                                    <option value="-">-</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                    <option value="O" selected>O</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="mb-2">
                                                <label for="">Pekerjaan</label>
                                                <input type="text" class="form-control" name="work[]" placeholder="Pekerjaan">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="">No Hp</label>
                                        <input type="text" name="phone[]" class="form-control" placeholder="Nomor telepon">
                                        <small class="text-danger" id="phoneError" style="display: none;">Format nomor HP tidak valid!</small>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Email</label>
                                        <input type="email" name="email[]" class="form-control" placeholder="E-mail">
                                        <small class="text-danger emailError" style="display: none;">Format email tidak valid!</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">RT <span class="text-danger">*</span></label>
                                                <?= generateInput($settings['perum_rt'], 'rt[]') ?>

                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">RW <span class="text-danger">*</span></label>
                                                <?= generateInput($settings['perum_rw'], 'rw[]') ?>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <label for="">No Rumah <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                                <?= generateInput($settings['perum_bloks'], 'blok[]') ?>
                                                <?= generateInput($settings['perum_blok_number'], 'blok_number[]') ?>
                                                <span class="input-group-text">No</span>
                                                <?= generateInput($settings['perum_home_number'], 'home_number[]') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="status_family[]" value="Kepala Keluarga">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top" id="containerButtonForm">
                    <button class="btn btn-info mb-0" id="add-family" type="button"><i class="fas fa-plus"></i> Anggota Keluarga</button>
                    <button class="btn btn-success mb-0" type="submit"><i class="fas fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    var getForm = function() {
        try {
            if ('<?= $family ?>' == '') {
                return true;
            }

            var dataForm = JSON.parse('<?= $family ?>');
            var kepalaKeluarga = dataForm[0];
            console.log(dataForm);

            // SET KEPALA KELUARGA
            $('[name=no_kk]').val(kepalaKeluarga.no_kk)
            setValueForm(kepalaKeluarga)

            // SET ANGGOTA KELUARGA
            var lastIndexMember = 0;
            $.each(dataForm, function(keyMember, valueMember) {
                if (keyMember == 0) {
                    return true;
                }

                addFamily(keyMember, valueMember)
                lastIndexMember = keyMember;
            })

            if (lastIndexMember != 0) {
                var removeButton = `<button class="btn btn-danger mb-1" id="removeMember" data-target_id="${lastIndexMember}" type="button"><i class="fas fa-times"></i> Anggota Terakhir</button>`
                $('#containerButtonForm').prepend(removeButton);
            }
        } catch (e) {
            $('#toast-bg').addClass('bg-danger');
            $('.toast-header strong').text('Peringatan!');
            $('.toast-body').html('Data tidak tersedia atau tidak valid. Hubungi administrator', e);
            bootstrap.Toast.getOrCreateInstance('#liveToast').show();
        }

    }

    var setValueForm = function(data, index = "") {
        $.each(data, function(key, value) {
            var selectors = [
                '[name="' + key + '[]"]:last',
                '[name^="' + key + '[' + index + ']"]:last',
            ].join(',');

            var selector = '';
            if (index == "") {
                selector = '[name="' + key + '[]"]';
            } else {
                selector = selectors

                if (key == 'email') {
                    return true;
                }
            }

            var elements = $(selector);

            if (elements.length) {
                if (key === 'blok') {
                    if (value == null) {
                        return true;
                    }

                    var rumah = value.match(/\d+/g);
                    var inputBlok = [
                        'blok_number', 'home_number'
                    ];

                    $.each(inputBlok, function(k, v) {
                        var elementBlok = $('[name="' + v + '[]"]:last');

                        if (elementBlok.is('select')) {
                            elementBlok.find('option[value="' + rumah[k] + '"]').prop('selected', true);
                        } else if (elementBlok.is('input')) {
                            elementBlok.val(rumah[k]);
                        }
                    });

                    return true;
                }

                if (elements.is(':radio')) {
                    elements = $(`[name^="${key}[${index}]"]`)
                    elements.each(function() {
                        if ($(this).val() == value) {
                            $(this).prop('checked', true);
                        }
                    });
                } else if (elements.is('input')) {
                    elements.val(value);
                } else if (elements.is('select')) {
                    elements.find('option[value="' + value + '"]').prop('selected', true);
                }
            }
        });
    }

    $('form').on('submit', function(e) {
        e.preventDefault(); // Mencegah pengiriman form secara default

        var no_kk = $('[name="no_kk"]').val();
        var blok_number = $('[name="blok_number[]"]');
        var home_number = $('[name="home_number[]"]');
        var isValid = true;
        var message = [];

        const checkHuruf = /[a-zA-Z]/;
        if (checkHuruf.test(no_kk)) {
            isValid = false;
            message.push('Tidak boleh ada huruf pada No. Kartu Keluarga');
        }

        if (no_kk.length != 16) {
            isValid = false;
            message.push('No Kartu Keluarga harus 16 karakter');
        }

        $('[name="no_ktp[]"]').each(function() {
            var no_ktp = $(this).val();

            if (no_ktp.length != 16) {
                $(this).addClass('is-invalid');
                isValid = false;
                message.push('NIK harus 16 karakter');
            } else {
                $(this).removeClass('is-invalid');
            }

            if (checkHuruf.test(no_ktp)) {
                $(this).addClass('is-invalid');
                isValid = false;
                message.push('Tidak boleh ada huruf pada NIK');
            } else {
                $(this).removeClass('is-invalid');
            }

            return false;
        });

        var blok = $('[name="blok[]"]').val() + blok_number.val() + " No " + home_number.val();

        if (blok_number.val() == 0) {
            blok_number.addClass('is-invalid');
            isValid = false;
            message.push('Nomor Blok tidak boleh 0');
        } else {
            blok_number.removeClass('is-invalid');
        }

        if (home_number.val() == 0) {
            home_number.addClass('is-invalid');
            isValid = false;
            message.push('Nomor Rumah tidak boleh 0');
        } else {
            home_number.removeClass('is-invalid');
        }

        if (!isValid) {
            var messages = message.join('<hr>');
            $('#toast-bg').addClass('bg-danger');
            $('.toast-header strong').text('Peringatan!');
            $('.toast-body').html(messages);
            bootstrap.Toast.getOrCreateInstance('#liveToast').show();
            return;
        }

        // Validasi blok melalui AJAX
        $.ajax({
            url: '<?= base_url() ?>users-man/check_data_user',
            method: 'POST',
            data: {
                no_kk: no_kk,
                blok: blok
            },
            dataType: 'JSON',
            success: function(result) {
                if (!result.blokNotUsed) {
                    isValid = false;
                    message.push('Nomor Rumah sudah terdaftar! Mohon cek kembali / hubungi administrator');
                    blok_number.addClass('is-invalid');
                    home_number.addClass('is-invalid');

                    var messages = message.join('<hr>');
                    $('#toast-bg').addClass('bg-danger');
                    $('.toast-header strong').text('Peringatan!');
                    $('.toast-body').html(messages);
                    bootstrap.Toast.getOrCreateInstance('#liveToast').show();
                }

                if (isValid) {
                    $('form')[0].submit();
                }
            }
        });
    });

    $(document).on('click', "button[id='removeMember']", function() {
        var target = $("button#removeMember").data('target_id');
        $("#member-family-" + target).remove()
        $("#removeMember").remove();

        var index = $('input[name="no_ktp[]"]').length;

        if (index > 1) {
            var removeButton = `<button class="btn btn-danger mb-1" id="removeMember" data-target_id="${index - 1}" type="button"><i class="fas fa-times"></i> Anggota Terakhir</button>`
            $('#containerButtonForm').prepend(removeButton);
        }
    });

    $(document).on("input blur", "input[name='phone[]']", function() {
        let phone = $(this).val().trim();
        let regex = /^(?:\+62|62|0)8[1-9][0-9]{7,11}$/; // Regex untuk nomor HP Indonesia
        if (phone === "" || regex.test(phone)) {
            $("#phoneError").hide();
            $(this).removeClass("is-invalid").addClass("is-valid");
        } else {
            $("#phoneError").show();
            $(this).removeClass("is-valid").addClass("is-invalid");
        }
    });

    $(document).on("input blur", "input[name='email[]']", function() {
        let email = $(this).val().trim();
        let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex validasi email
        let errorElement = $(this).next(".emailError"); // Cari error setelah input ini

        if (email === "" || regex.test(email)) {
            errorElement.hide();
            $(this).removeClass("is-invalid").addClass("is-valid");
        } else {
            errorElement.show();
            $(this).removeClass("is-valid").addClass("is-invalid");
        }
    });

    var addFamily = function(index, dataMember) {
        var html;

        html = `
        <div id="member-family-${index}">
            <hr>
            <h4 class="text-center">Anggota Keluarga</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-2">
                                <input type="hidden" name="id[]">
                                <label for="">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="no_ktp[]" required placeholder="Nomor Induk Kependudukan">
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="mb-2">
                                <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fullname[]" required placeholder="Nama Lengkap Anggota Keluarga">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="place_of_birth[]" required placeholder="Tempat Lahir">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-2">
                                <label for="">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="birth_of_day[]" required placeholder="Tanggal Lahir">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="">Jenis Kelamin <span class="text-danger">*</span></label>

                                <div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="gender[${index}]" id="male${index}" value="Laki - laki">
                                        <label class="form-check-label" for="male${index}">Laki - laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="gender[${index}]" id="female${index}" value="Perempuan">
                                        <label class="form-check-label" for="female${index}">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="">Status Perkawinan <span class="text-danger">*</span></label>

                                <div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="marital_status[${index}]" id="married${index}" value="Menikah">
                                        <label class="form-check-label" for="married${index}">Menikah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="marital_status[${index}]" id="single${index}" value="Belum Menikah">
                                        <label class="form-check-label" for="single${index}">Belum Menikah</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="">Agama <span class="text-danger">*</span></label>
                                <select name="religion[]" id="religion" class="form-select" required>
                                    <option value="">-- Pilih Agama</option>
                                    <option ${dataMember && dataMember.religion == 'Islam' ? 'selected' : '' } value="Islam">Islam</option>
                                    <option ${dataMember && dataMember.religion == 'Protestan' ? 'selected' : '' } value="Protestan">Protestan</option>
                                    <option ${dataMember && dataMember.religion == 'Katholik' ? 'selected' : '' } value="Katholik">Katholik</option>
                                    <option ${dataMember && dataMember.religion == 'Buddha' ? 'selected' : '' } value="Buddha">Buddha</option>
                                    <option ${dataMember && dataMember.religion == 'Hindu' ? 'selected' : '' } value="Hindu">Hindu</option>
                                    <option ${dataMember && dataMember.religion == 'Khonghucu' ? 'selected' : '' } value="Khonghucu">Khonghucu</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="">Golongan Darah</label>
                                <select name="blood_group[]" id="blood_group" class="form-select">
                                    <option value="-">-</option>
                                    <option ${dataMember && dataMember.blood_group == 'A' ? 'selected' : '' } value="A">A</option>
                                    <option ${dataMember && dataMember.blood_group == 'B' ? 'selected' : '' } value="B">B</option>
                                    <option ${dataMember && dataMember.blood_group == 'AB' ? 'selected' : '' } value="AB">AB</option>
                                    <option ${dataMember && dataMember.blood_group == 'O' ? 'selected' : '' } value="O">O</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="mb-2">
                                <label for="">Pekerjaan</label>
                                <input type="text" class="form-control" name="work[]" placeholder="Pekerjaan">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="">Hubungan <span class="text-danger">*</span></label>
                        <select name="status_family[]" id="status_family" class="form-select" required>
                            <option value="">-- Hubungan dengan kepala keluarga</option>
                            <option ${dataMember && dataMember.status_family == 'Istri' ? 'selected' : '' } value="Istri">Istri</option>
                            <option ${dataMember && dataMember.status_family == 'Anak' ? 'selected' : '' } value="Anak">Anak</option>
                            <option ${dataMember && dataMember.status_family == 'Lainnya' ? 'selected' : '' } value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="">No Hp</label>
                        <input type="text" name="phone[]" class="form-control" placeholder="Nomor telepon">
                        <small class="text-danger" id="phoneError" style="display: none;">Format nomor HP tidak valid!</small>
                    </div>
                    <div class="">
                        <input type="hidden" name="email[]" class="form-control" placeholder="E-mail">
                        <small class="text-danger emailError" style="display: none;">Format email tidak valid!</small>
                    </div>
                </div>
            </div>
        </div>
        `;


        $("#container-family").append(html);
        setValueForm(dataMember, index)
    }

    $("#add-family").on('click', function() {
        var index = $('input[name="no_ktp[]"]').length;
        $("#removeMember").data('target_id', index).remove()

        var removeButton = `<button class="btn btn-danger mb-1" id="removeMember" data-target_id="${index}" type="button"><i class="fas fa-times"></i> Anggota Terakhir</button>`
        $('#containerButtonForm').prepend(removeButton);

        addFamily(index);
    })

    getForm();
</script>
<?= $this->endSection('script'); ?>