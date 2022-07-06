<?= $this->extend('templates/layout') ?>
<?= $this->section('page-content') ?>
<div class="container-fluid">
    <h3>Data Jenis Wisata</h3>
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
                    <h4 class="card-title">Data Table Fasilitas Wisata</h4>

                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <button type="button" class="btn btn-primary" data-placement="bottom" title="Tambah" data-bs-toggle="modal" data-bs-target="#exampleModal2">Tambah Data
                        </button>
                    </div>
                    <div class="material-datatables">
                        <div class="devider"></div>
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">

                            <thead>
                                <tr>
                                    <th class="disabled-sorting ">No</th>
                                    <th class="disabled-sorting ">Nama Fasilitas</th>
                                    <th class="disabled-sorting ">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($dataF as $F) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $F['namaFasilitas'] ?></td>

                                        <td class="">
                                            <button type="button" class="btn btn-success btn-link" data-placement="bottom" title="Edit" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="buttonEdit('<?= $F['idFasilitas'] ?>','<?= $F['namaFasilitas'] ?>')">
                                                <i class="material-icons">edit</i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-link" data-placement="bottom" title="Remove" data-bs-toggle="modal" data-bs-target="#exampleModal3" onclick="buttonDelete('<?= $F['idFasilitas'] ?>','<?= $F['namaFasilitas'] ?>')">
                                                <i class="material-icons">close</i>
                                            </button>
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

    <!-- Tambah Master Data Fasilitas -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Tambah Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/Fasilitas/save" method="POST" id="TypeValidation">
                    <div class="modal-body text-center">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Nama Fasilitas</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control timepicker" id="namaFasilitas" name="namaFasilitas" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>
    <!-- End Tambah master Data Fasilitas -->


    <!-- Edit Master Data Fasilitas -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/fasilitas/update" method="POST" id="TypeValidation">
                    <div class="modal-body text-center">
                        <input type="text" class="form-control" id="UidFasilitas" name="UidFasilitas" hidden>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Jenis Wisata</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="UnamaFasilitas" name="UnamaFasilitas" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>
    <!-- End Edit Master Data Fasilitas -->


    <!-- Delete Master Data Fasilitas -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/fasilitas/delete" method="POST">
                    <input type="text" class="form-control" id="DidFasilitas" name="DidFasilitas" hidden>

                    <div class="modal-body text-center">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Fasilitas</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="DnamaFasilitas" name="DnamaFasilitas" disabled>
                                </div>
                            </div>
                        </div>


                        <p>Hapus data yang dipilih?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>

    <!-- End Delete Master Data Fasilitas -->
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<script>
    function buttonDelete($id, $fasilitas) {
        $('#DidFasilitas').val($id);
        $('#DnamaFasilitas').val($fasilitas);
    }

    function buttonEdit($id, $fasilitas) {
        $('#UidFasilitas').val($id);
        $('#UnamaFasilitas').val($fasilitas);

    }
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<?= $this->endSection() ?>