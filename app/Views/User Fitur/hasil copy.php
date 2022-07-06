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
                <div id="maps" hidden></div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="hasil()">Lihat Hasil</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<script>
    // Maps ganti BJB
    let map = L.map('maps').setView([-3.457242, 114.810318], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);



    // var x = 0;
</script>

<!-- Menempatkan Marker -->
<script>
    var awal = L.marker({
        lat: <?= $objek[0][0] ?>,
        lon: <?= $objek[0][1] ?>
    }).bindPopup('Titik Awal').addTo(map);


    <?php for ($x = 1; $x <= $jumlahW; $x++) {
    ?>
        L.marker({
            lat: <?= $objek[$x][0]['latWisata'] ?>,
            lon: <?= $objek[$x][0]['longWisata'] ?>
        }).bindPopup('<?= $objek[$x][0]['namaWisata'] ?>').addTo(map)
    <?php } ?>
</script>

<!-- Proses mencari Jarak  -->
<script>
    // Save ke variable
    const latLang = [];
    latLang[0] = L.latLng(<?= $objek[0][0] ?>, <?= $objek[0][1] ?>);

    <?php for ($x = 1; $x <= $jumlahW; $x++) {
    ?>
        latLang[<?= $x ?>] = L.latLng(<?= $objek[$x][0]['latWisata'] ?>, <?= $objek[$x][0]['longWisata'] ?>);

    <?php } ?>

    console.log(latLang);
    const wp = [];
    for (let index = 0; index < latLang.length; index++) {
        wp[index] = new L.Routing.Waypoint(latLang[index]);

    }

    const routeUs = [];
    const panjangRute = [];
    <?php for ($x = 1; $x <= $jumlahW; $x++) {
    ?>
        routeUs[<?= $x ?>] = L.Routing.osrmv1();
        routeUs[<?= $x ?>].route([wp[3], wp[<?= $x ?>]], (err, routes) => {
            if (!err) {
                let best = 100000000000000;
                let bestRoute = 0;
                for (i in routes) {
                    if (routes[i].summary.totalDistance < best) {
                        bestRoute = i;
                        best = routes[i].summary.totalDistance;
                    }
                }
                panjangRute[<?= $x ?>] = [routes[bestRoute].summary.totalDistance];
                console.log('best route  Danau Seran  Menuju objek ' + '<?= $objek[$x][0]['namaWisata'] ?>' + ' adalah: ', routes[bestRoute].summary.totalDistance);
                console.log('panjang Rute : ' + panjangRute[<?= $x ?>]);

                L.Routing.line(routes[bestRoute], {
                    styles: [{
                        color: 'yellow',


                        
                        weight: '10'
                    }]
                }).addTo(map);
            }
        });
    <?php } ?>
</script>




<script>
    function hasil() {
        $("#maps").removeAttr('hidden');
        setTimeout(function() {
            map.invalidateSize();
        }, 10);
        console.log('<?= $objek[1][0]['latWisata'] ?>');

    }
</script>

<?= $this->endSection() ?>