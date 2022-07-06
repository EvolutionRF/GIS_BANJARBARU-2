<?= $this->section('head') ?>

<script src="<?= base_url() ?>/leaflet/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css" />

<link rel="stylesheet" href="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="<?= base_url() ?>/leaflet-routing-machine/examples/Control.Geocoder.js"></script>

<style>
    #maps {
        height: 800px;
    }
</style>
<?= $this->endSection(); ?>


<?= $this->extend('templates/layout') ?>



<?= $this->section('page-content') ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Maps Wisata Banjarbaru</h4>
                    <!-- <p class="card-category">Peta Banjarbaru</p> -->
                </div>
                <div class="card-body">

                    <div class="row">
                        <label class="col-sm-3 col-form-label">Latitude</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="latitude" name="latitude">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Longitude</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="longitude" name="longitude">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">

                        <button class="btn btn-primary" onclick="getLocation()">Lokasi Saya</button>
                    </div>
                </div>
                <div id="maps"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<script>
    var latBJB = -3.457242;
    var LonBJB = 114.810318;
    let latLng = [-3.457242, 114.810318];

    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation == [-3.457242, 114.810318];
    }

    var map = L.map('maps').setView(
        latLng, 15);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);



    //add draggable marker and Position
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
        $("#latitude").val(position.lat);
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

    // End Dragable Marker



    <?php
    $namefile = "routing";
    $no = 0;
    foreach ($wisata as $w) {
        if ($fotoWisata[$no] == NULL) {

            $namefile = base_url() . '/assets/img/default.jpg';
        } else {

            $namefile = base_url() . '/assets/img/wisata/' . $fotoWisata[$no]->namafile;
        };
    ?>

        L.marker({
            lat: <?= $w['latWisata'] ?>,
            lon: <?= $w['longWisata'] ?>
        }).bindPopup('<div class="text-center"> <img class="img-thumbnail" src="<?= $namefile ?>" ><br>Nama Wisata : <?= $w['namaWisata'] ?><br> Alamat Wisata :  <?= $w['alamatWisata'] ?><br> <br> <a class="btn btn-info" href="wisata/detail/<?= $w['idWisata'] ?>" >Detail</a> <button class="btn btn-success" onclick="return keSini(<?= $w['latWisata'] ?>,<?= $w['longWisata'] ?>)">Kesini</a> </div>').addTo(map)

    <?php $no++;
    } ?>

    // NEW TRY
    // map.on('mousemove', (e) => {
    //     let latlng = e.latlng;
    //     console.log(latlng);
    //     $("#latitude").val(latlng.lat);
    //     $("#longitude").val(latlng.lng).keyup();
    // });







    var control = L.Routing.control({
        waypoints: [
            latLng
        ],
        routeWhileDragging: true,
        reverseWaypoints: true,
        showAlternatives: true,
        draggable: true,
        altLineOptions: {
            styles: [{
                    color: 'black',
                    opacity: 0.15,
                    weight: 9
                },
                {
                    color: 'white',
                    opacity: 0.8,
                    weight: 6
                },
                {
                    color: 'blue',
                    opacity: 0.5,
                    weight: 2
                }
            ]
        },
    })
    control.addTo(map);



    // get Location

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        console.log('Posisi Sekarang :', position.coords.latitude, position.coords.longitude);
        $("[name=latitude]").val(position.coords.latitude);
        $("[name=longitude]").val(position.coords.longitude);
        let latLng = [position.coords.latitude, position.coords.longitude];
        control.spliceWaypoints(0, 1, latLng);
        map.panTo(latLng);
    }

    // End Get Location


    function keSini(lat, lng) {
        var latLng = L.latLng(lat, lng);
        control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng)

    }
</script>

<?= $this->endSection() ?>