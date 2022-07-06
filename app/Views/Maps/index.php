<?= $this->section('head') ?>

<script src="<?= base_url() ?>/leaflet/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css" />

<link rel="stylesheet" href="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

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

        var map = L.map('maps').setView({
            lat: -3.457242,
            lon: 114.810318
        }, 12);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            maxZoom: 23,
            attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
        }).addTo(map);

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
            var greenIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            L.marker({
                lat: <?= $w['latWisata'] ?>,
                lon: <?= $w['longWisata'] ?>
            }, {
                icon: greenIcon
            }).bindPopup('<div class="text-center"> <img class="img-thumbnail" src="<?= $namefile ?>" ><br>Nama Wisata : <?= $w['namaWisata'] ?><br> Alamat Wisata :  <?= $w['alamatWisata'] ?><br> <br> <a class="btn btn-info" href="wisata/detail/<?= $w['idWisata'] ?>" >Detail</a> <button class="btn btn-success" <?= session()->get('namaUser') == null ? 'hidden' : '' ?> onclick="return keSini(<?= $w['latWisata'] ?>,<?= $w['longWisata'] ?>)">Kesini</a> </div>').addTo(map)

        <?php $no++;
        } ?>

        // L.marker({
        //     lat: latBJB,
        //     lon: LonBJB
        // }).bindPopup('Banjarbaru').addTo(map);



        var control = L.Routing.control({
            waypoints: [
                L.latLng(-3.457242, 114.810318)
            ],
            icon: greenIcon,
            routeWhileDragging: false
        })

        control.addTo(map);

        // L.marker({
        //     lat: -3.45700,
        //     lon: 114.810318
        // }).bindPopup('MTP').addTo(map)

        function keSini(lat, lng) {
            var latLng = L.latLng(lat, lng);
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, latLng)

        }
    </script>

    <?= $this->endSection() ?>