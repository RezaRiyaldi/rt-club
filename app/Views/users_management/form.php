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
                                <input type="text" name="no_kk" class="form-control" required placeholder="Nomor Kartu Keluarga" value="1234567890123456">
                            </div>
                        </div>

                        <div id="head-family">
                            <hr>

                            <h4 class="text-center">Kepala Keluarga</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- <div class="row">
                                        <div class="col-5">
                                            <div class="mb-2">
                                                <label for="">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username[]" required placeholder="Username" value="kepala1">
                                            </div>
                                        </div>

                                        <div class="col-7">
                                            <div class="mb-2">
                                                <label for="">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email[]" required placeholder="Email" value="test@test.com">
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-2">
                                                <label for="">NIK <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="no_ktp[]" required placeholder="Nomor Induk Kependudukan" value="0123456789012345">
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="mb-2">
                                                <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="fullname[]" required placeholder="Nama Lengkap Kepala Keluarga" value="Kepala Suku 1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="place_of_birth[]" required placeholder="Tempat Lahir" value="Bandung">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="birth_of_day[]" required placeholder="Tanggal Lahir" value="1999-12-03">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label for="">Jenis Kelamin <span class="text-danger">*</span></label>

                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio" name="gender[]" id="male" value="Laki - laki" checked>
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
                                                        <input required class="form-check-input" type="radio" name="marital_status[]" id="married" value="Menikah" checked>
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
                                    <div class="row">
                                        <!-- <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Provinsi <span class="text-danger">*</span></label>
                                                <select name="province[]" id="province" class="form-select" required>
                                                    <option>-- Pilih Provinsi</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Kab/Kota <span class="text-danger">*</span></label>
                                                <select name="regency[]" id="regency" class="form-select" required>
                                                    <option>-- Pilih Kab/Kota</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Kecamatan <span class="text-danger">*</span></label>
                                                <select name="district[]" id="district" class="form-select" required>
                                                    <option>-- Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Kelurahan <span class="text-danger">*</span></label>
                                                <select name="village[]" id="village" class="form-select" required>
                                                    <option>-- Pilih Kelurahan</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">RT <span class="text-danger">*</span></label>
                                                <!-- <input type="number" id="rt" class="form-control" name="rt[]" required placeholder="RT"> -->
                                                <?= generateInput($settings['perum_rt'], 'rt[]') ?>

                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">RW <span class="text-danger">*</span></label>
                                                <!-- <input type="number" id="rw" class="form-control" name="rw[]" required placeholder="RW"> -->
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

                                    <!-- <div class="mb-2">
                                        <label for="">Alamat <span class="text-danger">*</span></label>
                                        <textarea name="address[]" id="address" cols="30" rows="2" class="form-control" required placeholder="Contoh: Perum Kertamukti Sakti Blok Z99 no 99"></textarea>
                                    </div> -->

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
        var dataForm = ('<?= json_encode($family) ?>');

        console.log(dataForm)
    }
    getForm();

    // var getProvince = function(index = '') {
    //     $.ajax({
    //         url: '<?= base_url() ?>get-region/provinces',
    //         method: 'GET',
    //         dataType: 'JSON',
    //         success: function(province) {
    //             $("#province" + index).empty();
    //             var option;

    //             option += `<option>-- Pilih Provinsi</option>`;
    //             $.each(province, (key, val) => {
    //                 option += `<option value="${val.province}" id="${val.id}">${val.province}</option>`;
    //             })

    //             $("#province" + index).append(option)
    //         }
    //     })
    // }
    // getProvince()

    // var getRegency = function(provinceID, index = '') {
    //     $.ajax({
    //         url: `<?= base_url() ?>get-region/regencies/${provinceID}`,
    //         method: 'GET',
    //         dataType: 'JSON',
    //         success: function(regency) {
    //             $("#regency" + index).empty();
    //             var option;

    //             option += `<option>-- Pilih Kab/Kota</option>`;
    //             $.each(regency, (key, val) => {
    //                 option += `<option value="${val.regency}" id="${val.id}">${val.regency}</option>`;
    //             })

    //             $("#regency" + index).append(option)
    //         }
    //     })
    // }

    // var getDistrict = function(regencyID, index = '') {
    //     $.ajax({
    //         url: `<?= base_url() ?>get-region/districts/${regencyID}`,
    //         method: 'GET',
    //         dataType: 'JSON',
    //         success: function(district) {
    //             $("#district" + index).empty();
    //             var option;

    //             option += `<option>-- Pilih Kecamatan</option>`;
    //             $.each(district, (key, val) => {
    //                 option += `<option value="${val.district}" id="${val.id}">${val.district}</option>`;
    //             })

    //             $("#district" + index).append(option)
    //         }
    //     })
    // }

    // var getVillage = function(districtID, index = '') {
    //     $.ajax({
    //         url: `<?= base_url() ?>get-region/villages/${districtID}`,
    //         method: 'GET',
    //         dataType: 'JSON',
    //         success: function(village) {
    //             $("#village" + index).empty();
    //             var option;

    //             option += `<option>-- Pilih Kelurahan</option>`;
    //             $.each(village, (key, val) => {
    //                 option += `<option value="${val.village}" id="${val.id}">${val.village}</option>`;
    //             })

    //             $("#village" + index).append(option)
    //         }
    //     })
    // }

    // $(document).on('change', "select[id^='province']", function() {
    //     var id = $(this).attr("id");
    //     var matches = id.match(/\d+/);
    //     var selected = $(this).find(":selected").prop("id");

    //     var index;
    //     if (matches && matches.length > 0) {
    //         index = matches[0]
    //     } else {
    //         index = '';
    //     }

    //     getRegency(selected, index);

    //     $("#district" + index).empty().append('<option>-- Pilih Kecamatan</option>');
    //     $("#village" + index).empty().append('<option>-- Pilih Kelurahan</option>');
    // })

    // $(document).on('change', "select[id^='regency']", function() {
    //     var id = $(this).attr("id");
    //     var matches = id.match(/\d+/);
    //     var selected = $(this).find(":selected").prop("id");

    //     var index;
    //     if (matches && matches.length > 0) {
    //         index = matches[0]
    //     } else {
    //         index = '';
    //     }

    //     getDistrict(selected, index);

    //     $("#village" + index).empty().append('<option>-- Pilih Kelurahan</option>');
    // })

    // $(document).on('change', "select[id^='district']", function() {
    //     var id = $(this).attr("id");
    //     var matches = id.match(/\d+/);
    //     var selected = $(this).find(":selected").prop("id");

    //     var index;
    //     if (matches && matches.length > 0) {
    //         index = matches[0]
    //     } else {
    //         index = '';
    //     }

    //     getVillage(selected, index);
    // })

    // $(document).on('change', "input[id^='addressSame']", function() {
    //     var id = $(this).attr("id");
    //     var matches = id.match(/\d+/);

    //     var index;
    //     if (matches && matches.length > 0) {
    //         index = matches[0]
    //     } else {
    //         index = '';
    //     }

    //     var province;
    //     var regency;
    //     var district;
    //     var village;
    //     var rt = $("#rt" + index);
    //     var rw = $("#rw" + index);
    //     var address = $("#address" + index);

    //     if ($(this).is(":checked")) {
    //         console.log(`Checkbox ${index} dicentang.`);
    //         var provinceLead = $("#province").val();
    //         var regencyLead = $("#regency").val();
    //         var districtLead = $("#district").val();
    //         var villageLead = $("#village").val();
    //         var rtLead = $("#rt").val();
    //         var rwLead = $("#rw").val();
    //         var addressLead = $("#address").val();

    //         $("#province" + index).remove()
    //         $("#regency" + index).remove()
    //         $("#district" + index).remove()
    //         $("#village" + index).remove()

    //         $("#containerProvince" + index).append(`<input type="text" id="province${index}" class="form-control" name="province[${index}]" value="${provinceLead}" readonly />`)
    //         $("#containerRegency" + index).append(`<input type="text" id="regency${index}" class="form-control" name="regency[${index}]" value="${regencyLead}" readonly />`)
    //         $("#containerDistrict" + index).append(`<input type="text" id="district${index}" class="form-control" name="district[${index}]" value="${districtLead}" readonly />`)
    //         $("#containerVillage" + index).append(`<input type="text" id="village${index}" class="form-control" name="village[${index}]" value="${villageLead}" readonly />`)

    //         rt.val(rtLead)
    //         rt.attr('readonly', true)

    //         rw.val(rwLead)
    //         rw.attr('readonly', true)

    //         address.val(addressLead)
    //         address.attr('readonly', true)
    //     } else {
    //         $("#province" + index).remove()
    //         $("#regency" + index).remove()
    //         $("#district" + index).remove()
    //         $("#village" + index).remove()

    //         province = `<select name="province[${index}]" id="province${index}" class="form-select" required>
    //                         <option>-- Pilih Provinsi</option>
    //                     </select>`;
    //         $("#containerProvince" + index).append(province)
    //         getProvince(index)

    //         regency = `<select name="regency[${index}]" id="regency${index}" class="form-select" required>
    //                     <option>-- Pilih Kab/Kota</option>
    //                 </select>`;
    //         $("#containerRegency" + index).append(regency)

    //         district = `<select name="district[${index}]" id="district${index}" class="form-select" required>
    //                             <option>-- Pilih Kecamatan</option>
    //                         </select>`;
    //         $("#containerDistrict" + index).append(district)

    //         village = `<select name="village[${index}]" id="village${index}" class="form-select" required>
    //                     <option>-- Pilih Kelurahan</option>
    //                 </select>`;
    //         $("#containerVillage" + index).append(village)

    //         rt.val('')
    //         rt.attr('readonly', false)

    //         rw.val('')
    //         rw.attr('readonly', false)

    //         address.val('')
    //         address.attr('readonly', false)

    //     }
    // })

    $(document).on('click', "button[id='removeMember']", function() {
        var target = $("button#removeMember").data('target_id');
        $("#member-family-" + target).remove()
        $("#removeMember").remove();

        var index = $('input[name="no_ktp[]"]').length;

        if (index > 1) {
            var removeButton = `<button class="btn btn-danger mb-0" id="removeMember" data-target_id="${index - 1}" type="button"><i class="fas fa-times"></i> Anggota Terakhir</button>`
            $('#containerButtonForm').prepend(removeButton);
        }

    })

    var addFamily = function(index) {
        var html;

        html = `
        <div id="member-family-${index}">
            <hr>
            <h4 class="text-center">Anggota Keluarga</h4>
            <div class="row">
                <div class="col-md-6">`
                    // <div class="row">
                    //     <div class="col-5">
                    //         <div class="mb-2">
                    //             <label for="">Username <span class="text-danger">*</span></label>
                    //             <input type="text" class="form-control" name="username[]" required placeholder="Username">
                    //         </div>
                    //     </div>

                    //     <div class="col-7">
                    //         <div class="mb-2">
                    //             <label for="">Email <span class="text-danger">*</span></label>
                    //             <input type="email" class="form-control" name="email[]" required placeholder="Email">
                    //         </div>
                    //     </div>
                    // </div>
                    + `
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-2">
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
                                    <option value="Islam">Islam</option>
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
                                    <option value="O">O</option>
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
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>`

                    // <div class="mb-0 mt-2 alert alert-info py-1">
                    //     <div class="form-check form-check-inline">
                    //         <input class="form-check-input" type="checkbox" id="addressSame${index}">
                    //         <label class="form-check-label mb-0" for="addressSame${index}">Alamat sama dengan Kepala Keluarga</label>
                    //     </div>
                    // </div>
                    + `
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="">RT <span class="text-danger">*</span></label>
                                <!-- <input type="number" id="rt" class="form-control" name="rt[]" required placeholder="RT"> -->
                                <?= generateInput($settings['perum_rt'], 'rt[]') ?>

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-2">
                                <label for="">RW <span class="text-danger">*</span></label>
                                <!-- <input type="number" id="rw" class="form-control" name="rw[]" required placeholder="RW"> -->
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
                    </div>`
                        
                        // <div class="col-6">
                        //     <div class="mb-2" id="containerProvince${index}">
                        //         <label for="">Provinsi <span class="text-danger">*</span></label>
                        //         <select name="province[${index}]" id="province${index}" class="form-select" required>
                        //             <option>-- Pilih Provinsi</option>
                        //         </select>
                        //     </div>
                        // </div>

                        // <div class="col-6">
                        //     <div class="mb-2" id="containerRegency${index}">
                        //         <label for="">Kab/Kota <span class="text-danger">*</span></label>
                        //         <select name="regency[${index}]" id="regency${index}" class="form-select" required>
                        //             <option>-- Pilih Kab/Kota</option>
                        //         </select>
                        //     </div>
                        // </div>

                        // <div class="col-6">
                        //     <div class="mb-2" id="containerDistrict${index}">
                        //         <label for="">Kecamatan <span class="text-danger">*</span></label>
                        //         <select name="district[${index}]" id="district${index}" class="form-select" required>
                        //             <option>-- Pilih Kecamatan</option>
                        //         </select>
                        //     </div>
                        // </div>

                        // <div class="col-6">
                        //     <div class="mb-2" id="containerVillage${index}">
                        //         <label for="">Kelurahan <span class="text-danger">*</span></label>
                        //         <select name="village[${index}]" id="village${index}" class="form-select" required>
                        //             <option>-- Pilih Kelurahan</option>
                        //         </select>
                        //     </div>
                        // </div>
                    
                    
                    // <div class="mb-2">
                    //     <label for="">Alamat <span class="text-danger">*</span></label>
                    //     <textarea name="address[]" id="address${index}" cols="30" rows="2" class="form-control" required placeholder="Contoh: Perum Kertamukti Sakti Blok Z99 no 99"></textarea>
                    // </div>
                + `</div>
            </div>
        </div>
        `;


        $("#container-family").append(html);
    }

    $("#add-family").on('click', function() {
        var index = $('input[name="no_ktp[]"]').length;
        $("#removeMember").data('target_id', index).remove()

        var removeButton = `<button class="btn btn-danger mb-0" id="removeMember" data-target_id="${index}" type="button"><i class="fas fa-times"></i> Anggota Terakhir</button>`
        $('#containerButtonForm').prepend(removeButton);

        addFamily(index);
        // getProvince(index);
    })
</script>
<?= $this->endSection('script'); ?>