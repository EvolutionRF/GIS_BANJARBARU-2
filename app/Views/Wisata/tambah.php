<?= $this->section('head') ?>

<script src="<?= base_url() ?>/leaflet/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css" />

<link rel="stylesheet" href="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="<?= base_url() ?>/leaflet-routing-machine/examples/Control.Geocoder.js"></script>

<style>
    #maps {
        height: 400px;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->extend('templates/layout') ?>

<?= $this->section('page-content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="/wisata">
                <i class="material-icons">arrow_back</i>
            </a>
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">Tambah Wisata
                    </h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">

                                <!-- Form tambah Data Wisata -->

                                <div class="tab-pane active" id="link4">
                                    <div class="card col-md-10">
                                        <div class="card-header card-header-rose card-header-text">
                                            <div class="card-text">
                                                <h4 class="card-title">Data Wisata</h4>
                                            </div>

                                        </div>
                                        <div class="card-body ">
                                            <form method="POST" action="/wisata/save" class="form-horizontal" id="TypeValidation" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Nama Wisata</label>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control <?= ($validation->hasError('namaWisata')) ? 'is-invalid' : ''; ?>" id="namaWisata" name="namaWisata" value="<?= old('namaWisata') ?>">
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('namaWisata'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control <?= ($validation->hasError('alamatWisata')) ? 'is-invalid' : ''; ?>" id="alamatWisata" name="alamatWisata" value="<?= old('alamatWisata') ?>">
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('alamatWisata'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Kelurahan</label>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select class="selectpicker <?= ($validation->hasError('kodePos')) ? 'is-invalid' : ''; ?>" data-size="7" data-style="select-with-transition" title="Single Select" id="kodePos" name="kodePos">
                                                                <option disabled selected>Pilih Kelurahan</option>
                                                                <?php $no = 1;
                                                                foreach ($kodePos as $kP) {
                                                                ?>
                                                                    <option value="<?= $kP['idkodePos'] ?>" <?= (old('kodePos') == $kP['idkodePos']) ? 'selected' : '' ?>><?= $kP['kelurahan'] ?></option>

                                                                <?php
                                                                }  ?>

                                                            </select>

                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('kodePos'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Kontak Person</label>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control <?= ($validation->hasError('cp')) ? 'is-invalid' : ''; ?>" minLength="11" type="text" name="cp" id="cp" value="<?= old('cp') ?>" />
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('cp'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" row">
                                                    <label class="col-sm-2 col-form-label">Titik Koordinat</label>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="latitude" class="bmd-label-floating">Latitude</label>
                                                                            <input type="text" class="form-control <?= ($validation->hasError('latitude')) ? 'is-invalid' : ''; ?>" id="latitude" name="latitude" value="<?= old('latitude') ?>">

                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('latitude'); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="longitude" class="bmd-label-floating">Longitude</label>
                                                                            <input type="text" class="form-control <?= ($validation->hasError('longitude')) ? 'is-invalid' : ''; ?>" id="longitude" name="longitude" value="<?= old('longitude') ?>">
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('longitude'); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-info btn-sm" type="button" onclick="setMap()" id="pilih" name="pilih">Pilih Dipeta</button>
                                                                    <button class="btn btn-primary btn-sm" type="button" onclick="setMap2()" id="done" name="Done" hidden>Done</button>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div id="maps" hidden></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Jenis Wisata</label>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <select class="selectpicker <?= ($validation->hasError('jenisWisata')) ? 'is-invalid' : ''; ?>" data-size="7" data-style="select-with-transition" title="Single Select" id="jenisWisata" name="jenisWisata">

                                                                <option disabled selected>Pilih Jenis Wisata</option>
                                                                <?php
                                                                foreach ($jenisWisata as $jW) {
                                                                ?>
                                                                    <option value="<?= $jW['idjenisWisata'] ?>" <?= (old('jenisWisata') == $jW['idjenisWisata']) ? 'selected' : '' ?>><?= $jW['namaJenisWisata'] ?></option>

                                                                <?php
                                                                }  ?>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('jenisWisata'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Jam Operasional</label>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="idJam" name="idJam">

                                                                <option disabled selected>Pilih Jam Operasional</option>
                                                                <?php
                                                                foreach ($jamWisata as $jam) {
                                                                ?>
                                                                    <option value="<?= $jam['idJam'] ?>" <?= (old('idJam') == $jam['idJam']) ? 'selected' : '' ?>><?= $jam['jamBuka'] ?> -<?= $jam['jamTutup'] ?> </option>

                                                                <?php
                                                                }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <textarea class="form-control <?= ($validation->hasError('desc')) ? 'is-invalid' : ''; ?>" id="desc" name="desc"> <?= old('desc') ?></textarea>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('desc'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Foto Wisata</label>

                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail">
                                                                    <img src="<?= base_url() ?>/assets/img/image_placeholder.jpg">
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                                <div>
                                                                    <span class="btn btn-rose btn-round btn-file">
                                                                        <span class="fileinput-new">Select image</span>
                                                                        <span class="fileinput-exists">Change</span>
                                                                        <input type="file" name="fotoWisata" id="fotoWisata" class="" accept="image/png, image/gif, image/jpeg" />
                                                                    </span>
                                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>





                                                <div class="text-right">
                                                    <!-- <button type="button" class="btn btn-info" id="editW" onclick="editButton()">Edit</button>
                                                    <button type="button" class="btn btn-warning" id="cancelW" onclick="cancelButton()" style="display: none;">Cancel</button> -->
                                                    <button type="submit" class="btn btn-rose" id="tambah">Tambah</button>
                                                </div>
                                            </form>


                                            <!-- <script>
                                                function editButton() {
                                                    $('#editW').hide();
                                                    $('#cancelW, #saveW').show();

                                                    $(" #all").prop("disabled", false); } function cancelButton() { $('#editW').show(); $('#cancelW, #saveW').hide(); $("#all").prop("disabled", true); } </script> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Data Wisata -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>


<script>
    function setMap() {
        $('#maps').removeAttr('hidden');
        setTimeout(function() {
            map.invalidateSize();
        }, 10);
        $("#pilih").attr("hidden", true);
        $("#done").removeAttr('hidden');
    }

    function setMap2() {
        $("#pilih").removeAttr('hidden');
        $("#maps").attr("hidden", true);
        $("#done").attr("hidden", true);
    }
</script>
<script>
    $(document).ready(function() {
        // initialise Datetimepicker and Sliders
        md.initFormExtendedDatetimepickers();
        if ($('.slider').length != 0) {
            md.initSliders();
        }
    });
</script>

<!-- <script language="javascript" type="text/javascript" src="<?= base_url() ?>/TSP/coords.json"></script> -->
<script>
    function setFormValidation(id) {
        $(id).validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
            },
            errorPlacement: function(error, element) {
                $(element).closest('.form-group').append(error);
            },
        });
    }


    $(document).ready(function() {
        setFormValidation('#RegisterValidation');
        setFormValidation('#TypeValidation');
        setFormValidation('#LoginValidation');
        setFormValidation('#RangeValidation');
    });
</script>

<script>
    let latLng = [-3.457242, 114.810318];
    var map = L.map('maps').setView(
        latLng, 12.5);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);


    map.attributionControl.setPrefix(false);

    var marker = new L.marker({
        lat: -3.45700,
        lon: 114.810318
    }, {
        draggable: 'true'
    });
    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        console.log(position);
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        $("#latitude").val(position.lat).keyup();
        $("#longitude").val(position.lng).keyup();
    });

    $("#latitude, #longitude").change(function() {
        var position = [$("#latitude").val(), $("#longitude").val()];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
        console.log(position);
    });
    marker.addTo(map);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<?= $this->endSection() ?>