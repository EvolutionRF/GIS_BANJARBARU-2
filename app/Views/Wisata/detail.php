<?= $this->section('head') ?>
<script src="<?= base_url() ?>/leaflet/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css" />

<style>
    #maps {
        height: 500px;
    }
</style>

<style>


</style>

<?= $this->endSection(); ?>

<?= $this->extend('templates/layout') ?>

<?= $this->section('page-content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <a href="/wisata">
                <i class="material-icons">arrow_back</i>
            </a>

            <div class="page-categories text-center">
                <h3 class="title text-center"><?= $detailW[0]['namaWisata'] ?></h3>
                <br />

                <div class="text-center">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $i = 0;
                            foreach ($galeriW as $row) {
                                $actives = '';
                                if ($i == 0) {
                                    $actives = 'active';
                                }; ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
                            <?php $i++;
                            } ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $i = 0;
                            foreach ($galeriW as $row) {
                                $actives = '';
                                if ($i == 0) {
                                    $actives = 'active';
                                };
                            ?>
                                <div class="carousel-item <?= $actives; ?>">
                                    <img class="d-block w-100" src="<?= base_url() ?>/assets/img/wisata/<?= $row['namafile'] ?>">
                                </div>
                            <?php $i++;
                            } ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
                <br>
                <br>

                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#link7" role="tablist">
                            <i class="material-icons">info</i> Deskripsi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#link8" role="tablist">
                            <i class="material-icons">location_on</i> Lokasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#link9" role="tablist">
                            <i class="material-icons">help_outline</i> Detail
                        </a>
                    </li>
                    <?php if (session()->get('role') == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#link10" role="tablist">
                                <i class="material-icons">edit</i> Edit
                            </a>
                        </li>
                    <?php } else { ?>
                    <?php }; ?>



                </ul>


                <div class="tab-content tab-space tab-subcategories">
                    <div class="tab-pane active" id="link7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $detailW[0]['namaWisata'] ?></h4>
                                <p class="card-category">
                                    <?= $detailW[0]['keteranganJW'] ?>
                                </p>
                            </div>
                            <div class="card-body">
                                <?= $detailW[0]['deskripsiW'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="link8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lokasi</h4>
                                <p class="card-category">
                                    Lokasi Tempat Wisata
                                </p>
                            </div>
                            <div class="card-body">
                                <?= $detailW[0]['alamatWisata'] ?>
                                <br>
                                latitude : <?= $detailW[0]['latWisata'] ?>
                                Longitude : <?= $detailW[0]['longWisata'] ?>
                                <br>
                                <div id="maps"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="link9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail</h4>
                                <p class="card-category">
                                    Detail Tempat Wisata lebih Lanjut
                                </p>
                            </div>
                            <div class="card-body">
                                <p>Jam Operasional : <?= $detailW[0]['jamBuka'] ?> - <?= $detailW[0]['jamTutup'] ?></p>
                                <p>Contact Person : <?= $detailW[0]['cpWisata'] ?></p>
                                <h4 class="text-center"><b>Fasilitas</b></h4>
                                <p>
                                    <?php

                                    foreach ($fasilitasW as $Fw) { ?>
                                        <b> <?= $Fw['namaFasilitas'] ?>(<?= $Fw['keteranganF'] ?>)</b>,
                                    <?php } ?>
                                </p>



                            </div>
                        </div>
                    </div>




                    <?php if (session()->get('role') == 1) { ?>
                        <div class="tab-pane" id="link10">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Data</h4>
                                    <p class="card-category">
                                        Edit data
                                    </p>
                                </div>
                                <div class="card-body">
                                    Tampilan hanya muncul ketika user adalah admin
                                    <br>
                                    <a href="<?= base_url() ?>/wisata/edit/<?= $detailW[0]['idWisata'] ?>" class="btn btn-primary">Edit</a>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                    <?php }; ?>




                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="/wisata/delete/<?= $detailW[0]['idWisata']; ?>" class="btn btn-danger">
                    Delete~
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<script>
    var map = L.map('maps').setView({
        lat: <?= $detailW[0]['latWisata'] ?>,
        lon: <?= $detailW[0]['longWisata'] ?>
    }, 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 23,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    L.marker({
        lat: <?= $detailW[0]['latWisata'] ?>,
        lon: <?= $detailW[0]['longWisata'] ?>
    }).bindPopup('<?= $detailW[0]['namaWisata'] ?>').addTo(map)
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?= $this->endSection() ?>