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
                                    <div class="row">
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
                                    </div>

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
                                        <div class="col-6">
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
                                                <select name="city[]" id="city" class="form-select" required>
                                                    <option>-- Pilih Kab/Kota</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">Kecamatan <span class="text-danger">*</span></label>
                                                <select name="subdistrict[]" id="subdistrict" class="form-select" required>
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
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">RT <span class="text-danger">*</span></label>
                                                <input type="number" id="rt" class="form-control" name="rt[]" required placeholder="RT">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="">RW <span class="text-danger">*</span></label>
                                                <input type="number" id="rw" class="form-control" name="rw[]" required placeholder="RW">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label for="">Alamat <span class="text-danger">*</span></label>
                                        <textarea name="address[]" id="address" cols="30" rows="2" class="form-control" required placeholder="Contoh: Perum Kertamukti Sakti Blok Z99 no 99"></textarea>
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
    var getProvince = function(index = '') {
        $.ajax({
            url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
            method: 'GET',
            dataType: 'JSON',
            success: function(province) {
                $("#province" + index).empty();
                var option;

                option += `<option>-- Pilih Provinsi</option>`;
                $.each(province, (key, val) => {
                    option += `<option value="${val.name}" id="${val.id}">${val.name}</option>`;
                })

                $("#province" + index).append(option)
            }
        })
    }
    getProvince()

    var getCity = function(provinceID, index = '') {
        $.ajax({
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceID}.json`,
            method: 'GET',
            dataType: 'JSON',
            success: function(city) {
                $("#city" + index).empty();
                var option;

                option += `<option>-- Pilih Kab/Kota</option>`;
                $.each(city, (key, val) => {
                    option += `<option value="${val.name}" id="${val.id}">${val.name}</option>`;
                })

                $("#city" + index).append(option)
            }
        })
    }

    var getSubdistrict = function(cityID, index = '') {
        $.ajax({
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityID}.json`,
            method: 'GET',
            dataType: 'JSON',
            success: function(subdistrict) {
                $("#subdistrict" + index).empty();
                var option;

                option += `<option>-- Pilih Kecamatan</option>`;
                $.each(subdistrict, (key, val) => {
                    option += `<option value="${val.name}" id="${val.id}">${val.name}</option>`;
                })

                $("#subdistrict" + index).append(option)
            }
        })
    }

    var getVillage = function(subdistrictID, index = '') {
        $.ajax({
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${subdistrictID}.json`,
            method: 'GET',
            dataType: 'JSON',
            success: function(village) {
                $("#village" + index).empty();
                var option;

                option += `<option>-- Pilih Kelurahan</option>`;
                $.each(village, (key, val) => {
                    option += `<option value="${val.name}" id="${val.id}">${val.name}</option>`;
                })

                $("#village" + index).append(option)
            }
        })
    }

    $(document).on('change', "select[id^='province']", function() {
        var id = $(this).attr("id");
        var matches = id.match(/\d+/);
        var selected = $(this).find(":selected").prop("id");

        var index;
        if (matches && matches.length > 0) {
            index = matches[0]
        } else {
            index = '';
        }

        getCity(selected, index);
    })

    $(document).on('change', "select[id^='city']", function() {
        var id = $(this).attr("id");
        var matches = id.match(/\d+/);
        var selected = $(this).find(":selected").prop("id");

        var index;
        if (matches && matches.length > 0) {
            index = matches[0]
        } else {
            index = '';
        }

        getSubdistrict(selected, index);
    })

    $(document).on('change', "select[id^='subdistrict']", function() {
        var id = $(this).attr("id");
        var matches = id.match(/\d+/);
        var selected = $(this).find(":selected").prop("id");

        var index;
        if (matches && matches.length > 0) {
            index = matches[0]
        } else {
            index = '';
        }

        getVillage(selected, index);
    })

    $(document).on('change', "input[id^='addressSame']", function() {
        var id = $(this).attr("id");
        var matches = id.match(/\d+/);

        var index;
        if (matches && matches.length > 0) {
            index = matches[0]
        } else {
            index = '';
        }

        var province;
        var city;
        var subdistrict;
        var village;
        var rt = $("#rt" + index);
        var rw = $("#rw" + index);
        var address = $("#address" + index);

        if ($(this).is(":checked")) {
            console.log(`Checkbox ${index} dicentang.`);
            var provinceLead = $("#province").val();
            var cityLead = $("#city").val();
            var subdistrictLead = $("#subdistrict").val();
            var villageLead = $("#village").val();
            var rtLead = $("#rt").val();
            var rwLead = $("#rw").val();
            var addressLead = $("#address").val();

            $("#province" + index).remove()
            $("#city" + index).remove()
            $("#subdistrict" + index).remove()
            $("#village" + index).remove()

            $("#containerProvince" + index).append(`<input type="text" id="province${index}" class="form-control" name="province[${index}]" value="${provinceLead}" readonly />`)
            $("#containerCity" + index).append(`<input type="text" id="city${index}" class="form-control" name="city[${index}]" value="${cityLead}" readonly />`)
            $("#containerSubdistrict" + index).append(`<input type="text" id="subdistrict${index}" class="form-control" name="subdistrict[${index}]" value="${subdistrictLead}" readonly />`)
            $("#containerVillage" + index).append(`<input type="text" id="village${index}" class="form-control" name="village[${index}]" value="${villageLead}" readonly />`)

            rt.val(rtLead)
            rt.attr('readonly', true)

            rw.val(rwLead)
            rw.attr('readonly', true)

            address.val(addressLead)
            address.attr('readonly', true)
        } else {
            $("#province" + index).remove()
            $("#city" + index).remove()
            $("#subdistrict" + index).remove()
            $("#village" + index).remove()

            province = `<select name="province[${index}]" id="province${index}" class="form-select" required>
                            <option>-- Pilih Provinsi</option>
                        </select>`;
            $("#containerProvince" + index).append(province)
            getProvince(index)

            city = `<select name="city[${index}]" id="city${index}" class="form-select" required>
                        <option>-- Pilih Kab/Kota</option>
                    </select>`;
            $("#containerCity" + index).append(city)

            subdistrict = `<select name="subdistrict[${index}]" id="subdistrict${index}" class="form-select" required>
                                <option>-- Pilih Kecamatan</option>
                            </select>`;
            $("#containerSubdistrict" + index).append(subdistrict)

            village = `<select name="village[${index}]" id="village${index}" class="form-select" required>
                        <option>-- Pilih Kelurahan</option>
                    </select>`;
            $("#containerVillage" + index).append(village)

            rt.val('')
            rt.attr('readonly', false)

            rw.val('')
            rw.attr('readonly', false)

            address.val('')
            address.attr('readonly', false)

        }
    })

    $(document).on('click', "button[id='removeMember']", function() {
        var target = $("button#removeMember").data('target_id');
        $("#member-family-" + target).remove()
        $("#removeMember").remove();

        var index = $('input[name="username[]"]').length;

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
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-5">
                            <div class="mb-2">
                                <label for="">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username[]" required placeholder="Username">
                            </div>
                        </div>

                        <div class="col-7">
                            <div class="mb-2">
                                <label for="">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email[]" required placeholder="Email">
                            </div>
                        </div>
                    </div>

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
                    </div>

                    <div class="mb-0 mt-2 alert alert-info py-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="addressSame${index}">
                            <label class="form-check-label mb-0" for="addressSame${index}">Alamat sama dengan Kepala Keluarga</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2" id="containerProvince${index}">
                                <label for="">Provinsi <span class="text-danger">*</span></label>
                                <select name="province[${index}]" id="province${index}" class="form-select" required>
                                    <option>-- Pilih Provinsi</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-2" id="containerCity${index}">
                                <label for="">Kab/Kota <span class="text-danger">*</span></label>
                                <select name="city[${index}]" id="city${index}" class="form-select" required>
                                    <option>-- Pilih Kab/Kota</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-2" id="containerSubdistrict${index}">
                                <label for="">Kecamatan <span class="text-danger">*</span></label>
                                <select name="subdistrict[${index}]" id="subdistrict${index}" class="form-select" required>
                                    <option>-- Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-2" id="containerVillage${index}">
                                <label for="">Kelurahan <span class="text-danger">*</span></label>
                                <select name="village[${index}]" id="village${index}" class="form-select" required>
                                    <option>-- Pilih Kelurahan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-2">
                                <label for="">RT <span class="text-danger">*</span></label>
                                <input type="number" id="rt${index}" class="form-control" name="rt[]" required placeholder="RT">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-2">
                                <label for="">RW <span class="text-danger">*</span></label>
                                <input type="number" id="rw${index}" class="form-control" name="rw[]" required placeholder="RW">
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="">Alamat <span class="text-danger">*</span></label>
                        <textarea name="address[]" id="address${index}" cols="30" rows="2" class="form-control" required placeholder="Contoh: Perum Kertamukti Sakti Blok Z99 no 99"></textarea>
                    </div>
                </div>
            </div>
        </div>
        `;

        
        $("#container-family").append(html);
    }

    $("#add-family").on('click', function() {
        var index = $('input[name="username[]"]').length;
        $("#removeMember").data('target_id', index).remove()

        var removeButton = `<button class="btn btn-danger mb-0" id="removeMember" data-target_id="${index}" type="button"><i class="fas fa-times"></i> Anggota Terakhir</button>`
        $('#containerButtonForm').prepend(removeButton);

        addFamily(index);
        getProvince(index);
    })
</script>
<?= $this->endSection('script'); ?>