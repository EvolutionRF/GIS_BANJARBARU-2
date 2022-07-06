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

<div class="container-fluid ">
    <h3 class="text-center">Rekomendasi Rute Wisata</h3>
    <br>
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="toolbar ">
                        <form action="/userFitur/proses" method="POST">
                            <input type="text" class="form-control" id="Didjam" name="Didjam" hidden>

                            <div class="modal-body">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Lokasi Awal</label>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="latitude" class="bmd-label-floating">Latitude</label>
                                            <input type="text" class="form-control" id="latitude" name="latitude">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="latitude" class="bmd-label-floating">Longitude</label>
                                            <input type="text" class="form-control" id="longitude" name="longitude">
                                        </div>
                                    </div>
                                    <button class="btn btn-info btn-sm" type="button" onclick="setMap()" id="pilih" name="pilih">Pilih Dipeta</button>
                                    <button class="btn btn-primary btn-sm" type="button" onclick="setMap2()" id="done" name="Done" hidden>Done</button>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 ml-auto mr-auto">
                                        <div id="maps" hidden></div>
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Jumlah Wisata</label>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="jumlah" name="jumlah">
                                                <option value="4">4</option>
                                                <option value="6">6</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <h4 hidden id="headerss">Tentukan Destinasi Wisata Wisata</h4>
                                    <div id="listWisata">
                                        <div id="1sampai4" hidden>
                                            <!-- 1 -->
                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 1</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisata-1" name="wisata-1">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 2 -->
                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 2</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisata-2" name="wisata-2">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 3 -->
                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 3</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisata-3" name="wisata-3">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 4 -->
                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 4</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisata-4" name="wisata-4">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="1sampai6" hidden>

                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 5</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisat-5" name="wisata-5">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 6 -->
                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 6</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisata-6" name="wisata-6">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="1sampai8" hidden>
                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 7</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisata-7" name="wisata-7">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 8 -->
                                            <div class="row" id="select">
                                                <label class="col-sm-3 col-form-label">Wisata 8</label>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="wisata-8" name="wisata-8">
                                                            <?php
                                                            foreach ($wisata as $W) {
                                                            ?>
                                                                <option value="<?= $W['idWisata'] ?>"><?= $W['namaWisata'] ?></option>

                                                            <?php
                                                            }  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" data-placement="bottom" title="Proses">Proses</button>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
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


    $("#jumlah").change(function() {

        $("#headerss").removeAttr('hidden');
        var x = document.getElementById("jumlah").value;
        if (x == '4') {
            $("#1sampai4").removeAttr('hidden');
            $("#1sampai6").attr("hidden", true);
            $("#1sampai8").attr("hidden", true);
        } else if (x == '6') {
            $("#1sampai4").removeAttr('hidden');
            $("#1sampai6").removeAttr('hidden');
            $("#1sampai8").attr("hidden", true);

        } else if (x == '8') {
            $("#1sampai4").removeAttr('hidden');
            $("#1sampai6").removeAttr('hidden');
            $("#1sampai8").removeAttr('hidden');
        }
    });
</script>

<script>
    let latLng = [-3.457242, 114.810318];
    var map = L.map('maps').setView(
        latLng, 15);

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

    $("#latitude,#longitude").change(function() {
        var position = [parseInt($("#latitude").val()), parseInt($("#longitude").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
    });
    marker.addTo(map);
</script>


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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<?= $this->endSection(); ?>