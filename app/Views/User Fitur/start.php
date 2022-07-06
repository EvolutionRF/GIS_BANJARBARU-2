<?= $this->section('head') ?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url() ?>/TSP/config.js"></script>
<script src="<?= base_url() ?>/TSP/coords.js"></script>
<?= $this->endSection(); ?>


<?= $this->extend('templates/layout') ?>



<?= $this->section('page-content') ?>
<div class="container vh-100">
    <div class="d-flex flex-row justify-content-center align-items-center vh-100 w-100 text-center">
        <div class="p-2">
            <h3>Algoritma Genetika</h3>
            <hr class="border-dark" />
            Sistem pencari jalur terpendek destinasi wisata di Banjarbaru
            <div class="mt-5"></div>

            <div class="row text-left">
                <div class="col-md-12">
                    <form id="form" method="POST" action="/userFitur/proses">
                        <label>Jumlah Destinasi</label>
                        <input name="totalCities" type="text" class="form-control" type="number" value="10" max="30" min="5" placeholder="2">

                        <label class="mt-3">Titik Awal</label>
                        <select name="startIndex" class="form-control " id="start-index">

                        </select>

                        <label class="mt-3">Max Iteration</label>
                        <input name="maxIter" type="text" class="form-control mb-3" type="number" value="1000" max="5000" min="500" placeholder="2">

                        <button type="submit" class="btn btn-primary btn-block">Fire!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        console.log(coords);
        for (let i = 0; i < coords.length; i++) {
            const element = coords[i];
            $("#start-index").append('<option value="' + i + '">' + element.name + '</option>')
        }
    });
</script>
<?= $this->endSection() ?>