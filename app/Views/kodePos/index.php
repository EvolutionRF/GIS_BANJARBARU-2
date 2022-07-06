<?= $this->extend('templates/layout') ?>

<?= $this->section('page-content') ?>

<div class="container-fluid">
    <h3>Data Kode Pos</h3>
    <br>
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
                    <h4 class="card-title">Data Table Kode Pos</h4>

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
                                    <th class="disabled-sorting ">Kode Pos</th>
                                    <th class="disabled-sorting ">Kelurahah</th>
                                    <th class="disabled-sorting ">Kecamatan</th>
                                    <th class="disabled-sorting ">Kota</th>
                                    <th class="disabled-sorting ">Latitude</th>
                                    <th class="disabled-sorting ">Longitude</th>
                                    <th class="disabled-sorting ">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <?php $no = 1;
                                    foreach ($dataK as $W) {
                                    ?>
                                        <td><?= $no ?></td>
                                        <td><?= $W['kodePos'] ?></td>
                                        <td>
                                            <div><?= $W['kelurahan'] ?></div>
                                        </td>
                                        <td><?= $W['kecamatan'] ?></td>
                                        <td><?= $W['kota'] ?></td>
                                        <td><?= $W['latitude_kel'] ?></td>
                                        <td><?= $W['longitude_kel'] ?></td>
                                        <td class="">
                                            <button type="button" class="btn btn-success btn-link" data-placement="bottom" title="Edit" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="buttonEdit(<?= $W['idkodePos'] ?>,<?= $W['kodePos'] ?>,'<?= $W['kelurahan'] ?>','<?= $W['kecamatan'] ?>','<?= $W['kota'] ?>','<?= $W['latitude_kel'] ?>','<?= $W['longitude_kel'] ?>')">
                                                <i class="material-icons">edit</i>
                                            </button>



                                            <button type="button" class="btn btn-danger btn-link" data-placement="bottom" title="Remove" data-bs-toggle="modal" data-bs-target="#exampleModal3" onclick="buttonDelete(<?= $W['idkodePos'] ?>,<?= $W['kodePos'] ?>,'<?= $W['kelurahan'] ?>','<?= $W['kecamatan'] ?>','<?= $W['kota'] ?>','<?= $W['latitude_kel'] ?>','<?= $W['longitude_kel'] ?>')">
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

</div>
<!-- Modal Edit -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kode Pos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/kodePos/update" method="POST">
                <input type="text" class="form-control" id="idkodePos" name="idkodePos" hidden>

                <div class="modal-body text-center">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kode Pos</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kodePos" name="kodePos">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kelurahan</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <select class="selectpicker" data-size="6" data-style="select-with-transition" title="Single Select" id="kecamatan" name="kecamatan">
                                    <option disabled>Pilih Kecamatan</option>
                                    <option value="Liang Anggang">Liang Anggang</option>
                                    <option value="Landasan Ulin">Landasan Ulin</option>
                                    <option value="Cempaka">Cempaka</option>
                                    <option value="Banjarbaru Utara">Banjarbaru Utara</option>
                                    <option value="Banjarbaru Selatan">Banjarbaru Selatan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kota</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kota" name="kota">
                            </div>
                        </div>
                    </div>
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
<!-- Edit -->


<!-- TAMBAH Kode Pos -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Tambah Kode Pos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/kodePos/save" method="POST" id="TypeValidation">
                <input type="text" class="form-control" id="idkodePos" name="idkodePos" hidden>

                <div class="modal-body text-center">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kode Pos</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kodePos" name="kodePos" required number="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kelurahan</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <select class="selectpicker" data-size="6" data-style="select-with-transition" title="Single Select" id="kecamatan" name="kecamatan">
                                    <option disabled selected>Pilih Kecamatan</option>
                                    <option value="Liang Anggang">Liang Anggang</option>
                                    <option value="Landasan Ulin">Landasan Ulin</option>
                                    <option value="Cempaka">Cempaka</option>
                                    <option value="Banjarbaru Utara">Banjarbaru Utara</option>
                                    <option value="Banjarbaru Selatan">Banjarbaru Selatan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kota</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kota" name="kota" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Latitude</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="latitude" name="latitude" number="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Longitude</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="longitude" name="longitude" number="true">
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
<!-- Tambah Kode Pos -->

<!-- Delete -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Kode Pos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/kodePos/delete" method="POST">
                <input type="text" class="form-control" id="DidkodePos" name="DidkodePos" hidden>

                <div class="modal-body text-center">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kode Pos</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="DkodePos" name="DkodePos" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kelurahan</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="Dkelurahan" name="Dkelurahan" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <select class="selectpicker" data-size="6" data-style="select-with-transition" title="Single Select" id="Dkecamatan" name="Dkecamatan" disabled>
                                    <option disabled>Pilih Kecamatan</option>
                                    <option value="Liang Anggang">Liang Anggang</option>
                                    <option value="Landasan Ulin">Landasan Ulin</option>
                                    <option value="Cempaka">Cempaka</option>
                                    <option value="Banjarbaru Utara">Banjarbaru Utara</option>
                                    <option value="Banjarbaru Selatan">Banjarbaru Selatan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Kota</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="Dkota" name="Dkota" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Latitude</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="Dlatitude" name="Dlatitude" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Longitude</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="Dlongitude" name="Dlongitude" disabled>
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
<!-- Delete -->

<?= $this->endSection() ?>
<?= $this->section('script') ?>

<script>
    function buttonEdit($id, $kodepos, $kelurahan, $kecamatan, $kota, $latitude, $longitude) {
        $('#idkodePos').val($id);
        $('#kodePos').val($kodepos);
        $('#kelurahan').val($kelurahan);
        $('#kecamatan').val($kecamatan).change();
        $('#kota').val($kota);
        $('#latitude').val($latitude);
        $('#longitude').val($longitude);
    }

    function buttonDelete($id, $kodepos, $kelurahan, $kecamatan, $kota, $latitude, $longitude) {
        $('#DidkodePos').val($id);
        $('#DkodePos').val($kodepos);
        $('#Dkelurahan').val($kelurahan);
        $('#Dkecamatan').val($kecamatan).change();
        $('#Dkota').val($kota);
        $('#Dlatitude').val($latitude);
        $('#Dlongitude').val($longitude);
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