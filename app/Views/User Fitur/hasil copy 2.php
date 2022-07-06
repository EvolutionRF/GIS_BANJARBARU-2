<?= $this->section('head') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<script language="javascript" type="text/javascript" src="<?= base_url() ?>/TSP/config.js"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
<?= $this->endSection(); ?>

<?= $this->extend('templates/layout') ?>



<?= $this->section('page-content') ?>
<h2 class="text-center">Rekomendasi Rute Wisata Banjarbaru</h2>
<div class="container-flex mt-5 p-5">
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Route & Maps</h3>
                    <div id="canvas" style="width: auto;display: none;"></div>
                    <div id="map" class="map map-home" style="height:500px"></div>
                    <small>
                        Ket:<br />

                        <div class="d-flex justify-content-between">
                            <span>
                                <span class="badge-danger" style="background:blue;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> : Jalur Terbaik
                            </span>
                            <span>
                                <span class="badge-danger" style="background:red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> : Jalur Terburuk
                            </span>
                            <span>
                                <span class="badge-danger" style="background:black;opacity: 0.3;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> : Iterasi Pencarian Jalur
                            </span>
                        </div>
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3>Koordinat</h3>
                            <div id="cities_coordinate"></div>
                        </div>
                        <div class="col-6">
                            <h3>Iteration</h3>
                            <div id="iteration"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- <script language="javascript" type="text/javascript" src="<?= base_url() ?>/TSP/coords.js"></script> -->
<script>
    (function() {

        let f = '<?= $path ?>';
        let pathx = f.split("#!/");
        console.log(pathx);

        $.getJSON("/TSP/coords.json", function(coords) {
            if (pathx.length == 2) {
                path = pathx[1]
                paths = path.split("&");
                var allowed = ['totalCities', 'maxIter', 'startIndex']
                paths.forEach((element, index) => {
                    var conf = element.split("=");
                    window.config[conf[0]] = conf[1];
                });
                var tmp = coords[0];
                var si = parseInt(window.config.startIndex);
                coords[0] = coords[si]

                console.log(coords[0]);
                coords[si] = tmp;
            }
            console.log(coords);
        });


    })()
</script>

<script>
    var mymap = L.map('map', {
        fullscreenControl: true
    }).setView([-3.4667, 114.75], 12.35);
    L.Polyline = L.Polyline.include({
        getDistance: function(system) {
            // distance in meters
            var mDistanse = 0,
                length = this._latlngs.length;
            for (var i = 1; i < length; i++) {
                mDistanse += this._latlngs[i].distanceTo(this._latlngs[i - 1]);
            }
            // optional
            if (system === 'imperial') {
                return mDistanse / 1609.34;
            } else {
                return mDistanse / 1000;
            }
        }
    });
    var redIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    for (let i = 0; i < config.totalCities; i++) {
        const element = coords[i];
        if (i == 0) {
            var marker = new L.marker([element.long, element.lat], {
                icon: redIcon
            });
        } else {
            var marker = new L.marker([element.long, element.lat]);
        }
        marker.bindTooltip(element.name);
        marker.addTo(mymap);
    }
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    var pointList = [new L.LatLng(coords[0].long, coords[0].lat), new L.LatLng(coords[1].long, coords[1].lat)];

    var firstpolyline = new L.Polyline(pointList, {
        color: 'blue',
        weight: 3,
        opacity: 1,
        smoothFactor: 1
    });

    var secondPolyline = new L.Polyline(pointList, {
        color: 'red',
        weight: 3,
        opacity: 1,
        smoothFactor: 1
    });
    secondPolyline.addTo(mymap);

    var trial = new L.Polyline(pointList, {
        color: 'black',
        weight: 3,
        opacity: 0.5,
        smoothFactor: 1
    });
    trial.addTo(mymap);
</script>
<script language="javascript" type="text/javascript" src="<?= base_url() ?>/TSP/libraries/p5.js"></script>

<script language="javascript" src="<?= base_url() ?>/TSP/libraries/p5.dom.js"></script>
<script src="<?= base_url() ?>/TSP/map.js" type="text/javascript"></script>


<script language="javascript" type="text/javascript" src="<?= base_url() ?>/TSP/sketch.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url() ?>/TSP/dna.js"></script>
<?= $this->endSection() ?>




<?= $this->section('script') ?>


<?= $this->endSection(); ?>