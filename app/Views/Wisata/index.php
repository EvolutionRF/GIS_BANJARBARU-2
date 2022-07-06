<?= $this->extend('templates/layout') ?>

<?= $this->section('page-content') ?>

<div class="container-fluid">
    <h3>Data Wisata Banjarbaru</h3>
    <?php if (session()->getFlashdata('pesan')) { ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php } elseif (session()->getFlashdata('pesanDel')) { ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('pesanDel'); ?>
        </div>
    <?php } elseif (session()->getFlashdata('pesanWarn')) { ?>
        <div class="alert alert-warning" role="alert">
            <?= session()->getFlashdata('pesanWarn'); ?>
        </div>
    <?php }; ?>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Data Table Wisata Banjarbaru</h4>

                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <a href="/wisata/tambah" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="material-datatables">
                        <div class="devider"></div>
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">

                            <thead>
                                <tr>
                                    <th class="disabled-sorting ">No</th>
                                    <th class="disabled-sorting ">Nama Wisata</th>
                                    <th class="disabled-sorting " style="width: 300px;">Alamat</th>
                                    <th class="disabled-sorting ">Jam Buka - Jam Tutup</th>
                                    <th class="disabled-sorting ">Jenis Wisata</th>
                                    <th class="disabled-sorting ">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <?php $no = 1;
                                    foreach ($dataW as $W) {
                                    ?>
                                        <td><?= $no ?></td>
                                        <td><?= $W['namaWisata'] ?></td>
                                        <td>
                                            <div style="word-wrap: break-word; width: 250px;"><?= $W['alamatWisata'] ?></div>
                                        </td>
                                        <td><?= $W['jamBuka'] ?> - <?= $W['jamTutup'] ?></td>
                                        <td><?= $W['namaJenisWisata'] ?></td>
                                        <td class="">
                                            <a href="<?= base_url() ?>/wisata/edit/<?= $W['idWisata'] ?>" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">edit</i></a>
                                            <a href="<?= base_url() ?>/wisata/detail/<?= $W['idWisata'] ?>" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">info</i></a>
                                        </td>
                                </tr>
                            <?php $no++;
                                    }  ?>

                            </tbody>
                        </table>
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


<?= $this->endSection() ?>