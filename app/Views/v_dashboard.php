<?= $this->section('head') ?>
<style>
    .center-cropped {
        width: 400px;
        height: 400px;
        background-position: center center;
        background-repeat: no-repeat;
        scale: auto;
    }
</style>
<?= $this->endSection() ?>

<?= $this->extend('templates/layout') ?>

<?= $this->section('page-content') ?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Destinasi Wisata Banjarbaru</h4>
            </div>
            <form class="navbar-form" method="POST">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="row">
                        <div class="card-body text-center">
                            <div class="input-group no-border">
                                <input type="text" name="keyword" class="form-control" placeholder="Cari Wisata">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="input-group no-border">
                                <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Single Select" id="kodePos" name="kodePos">
                                    <option disabled selected value="">Semua Kelurahan</option>
                                    <?php $no = 1;
                                    foreach ($include['kdPos'] as $K) {
                                    ?>
                                        <option value="<?= $K['idkodePos'] ?>"><?= $K['kelurahan'] ?></option>

                                    <?php
                                    }  ?>

                                </select>
                            </div>

                        </div>

                        <div class="card-body text-center">
                            <div class="input-group no-border">

                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <?php if ($search['keyword'] == "" && $search['lokasi'] == "") { ?>

            <?php } else { ?>
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="card-body text-center">
                        <?php $lokasi = "";
                        foreach ($include['kdPos'] as $K) { ?>
                            <?php if ($K['idkodePos'] == $search['lokasi']) {
                                $lokasi = $K['kelurahan'];
                            } ?>
                        <?php }; ?>

                        <?php if ($lokasi == "") {
                            $lokasi = "Semua Kelurahan";
                        } ?>
                        <p>Menampilkan Hasil Pencarian "<?= $search['keyword'] ?>" dan Lokasi <?= $lokasi ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br>
        <br>
    </div>



    <div class="row">

        <?php
        // dd($include, $dataW);
        // dd($dataW);
        // dd($dataW, $fotoWisata);

        $no = 0;
        foreach ($dataW as $W) {
            // dd($F);
        ?>
            <div class="col-md-4">
                <div class="card card-product">
                    <div class="card-header card-header-image" data-header-animation="true">
                        <a href="#pablo">

                            <img class="img-thumbnail " src="<?= base_url() ?>/assets/img/wisata/<?= $fotoWisata[$no]->namafile ?>">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card-actions text-center">
                            <a type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="View Detail" href="/wisata/detail/<?= $W['idWisata'] ?>">
                                <i class="material-icons">art_track</i>
                            </a>
                        </div>
                        <h4 class="card-title">
                            <b><?= $W['namaWisata'] ?></b>
                        </h4>
                        <div class="card-description">

                            <?php
                            foreach ($include['jenis'] as $J) {
                                if ($J['idjenisWisata'] == $W['idjenisWisata']) {
                                    $jenis =  $J['namaJenisWisata'];
                                };  ?>
                            <?php }; ?>
                            <?= $jenis ?>


                        </div>
                        <div class="card-description">
                            <?= $W['alamatWisata'] ?>
                        </div>
                    </div>
                    <div class="card-footer">

                        <div class="price">
                            <?php foreach ($include['jamOp'] as $Op) { ?>
                                <?php if ($Op['idJam'] == $W['idJam']) {
                                    $jamB = $Op['jamBuka'];
                                    $jamT = $Op['jamTutup'];
                                } ?>
                            <?php }; ?>
                            <p class="card-category"> <?= $jamB ?> - <?= $jamT ?> </p>

                        </div>

                        <div class="stats">
                            <?php foreach ($include['kdPos'] as $K) { ?>
                                <?php if ($K['idkodePos'] == $W['idkodePos']) {
                                    $kdPos = $K['kelurahan'];
                                } ?>
                            <?php }; ?>
                            <p class="card-category"><i class="material-icons">place</i> <?= $kdPos ?> </p>

                        </div>
                    </div>
                </div>
            </div>
            <br>

        <?php
            $no++;
        }; ?>



    </div>
    <?php if ($pager == "") {
    ?>
    <?php } else { ?>
        <div class="col-md-1 ml-auto mr-auto">
            <?= $pager->links('wisata', 'wisata_pagination') ?>
        </div>
    <?php } ?>


</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        var table = $('#datatable').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });
    });
</script>
<?= $this->endSection(); ?>