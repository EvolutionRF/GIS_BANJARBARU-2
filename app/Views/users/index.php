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
    <!-- ADMIN -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Data Admin</h4>

            </div>

            <div class="card-body">
                <div class="toolbar">
                    <button type="button" class="btn btn-primary" data-placement="bottom" title="Tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data
                    </button>
                    <?php if (session()->getFlashdata('pesan1')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan1'); ?>
                        </div>
                    <?php } elseif (session()->getFlashdata('pesanDel1')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('pesanDel1'); ?>
                        </div>
                    <?php } elseif (session()->getFlashdata('pesanWarn1')) { ?>
                        <div class="alert alert-warning" role="alert">
                            <?= session()->getFlashdata('pesanWarn1'); ?>
                        </div>
                    <?php }; ?>
                </div>
                <div class="material-datatables">
                    <div class="devider"></div>
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <div class="text-center">
                            <thead>
                                <tr>
                                    <th class="disabled-sorting ">No</th>
                                    <th class="disabled-sorting ">Nama</th>
                                    <th class="disabled-sorting ">User Name</th>
                                    <th class="disabled-sorting ">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <?php $no = 1;
                                    foreach ($admin as $A) {
                                    ?>
                                        <td><?= $no ?></td>
                                        <td><?= $A['namaUser'] ?></td>
                                        <td><?= $A['username'] ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-link" data-placement="bottom" title="Reset Password" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="resetButton('<?= $A['idUsers'] ?>','<?= $A['username'] ?>','<?= $A['namaUser'] ?>','<?= $A['role'] ?>')">
                                                <i class="material-icons">loop</i>
                                            </button>


                                            <button type="button" class="btn btn-danger btn-link" data-placement="bottom" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal3" <?= ($A['namaUser'] == 'super admin') ? 'hidden' : ''; ?> onclick="deleteButton('<?= $A['idUsers'] ?>','<?= $A['username'] ?>','<?= $A['namaUser'] ?>','<?= $A['role'] ?>')">
                                                <i class="material-icons">delete</i>
                                            </button>

                                        </td>
                                </tr>
                            <?php $no++;
                                    }  ?>
                        </div>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <br>
    <br>
    <!-- END ADMIN -->

    <!-- USER -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Data Users</h4>

            </div>
            <div class="card-body">
                <div class="toolbar">
                    <?php if (session()->getFlashdata('pesan2')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan2'); ?>
                        </div>
                    <?php } elseif (session()->getFlashdata('pesanDel2')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('pesanDel2'); ?>
                        </div>
                    <?php } elseif (session()->getFlashdata('pesanWarn2')) { ?>
                        <div class="alert alert-warning" role="alert">
                            <?= session()->getFlashdata('pesanWarn2'); ?>
                        </div>
                    <?php }; ?>
                </div>
                <div class="material-datatables">
                    <div class="devider"></div>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">

                        <div class="text-center">
                            <thead>
                                <tr>
                                    <th class="disabled-sorting ">No</th>
                                    <th class="disabled-sorting ">Nama</th>
                                    <th class="disabled-sorting ">User Name</th>
                                    <th class="disabled-sorting ">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <?php $no = 1;
                                    foreach ($users as $U) {
                                    ?>
                                        <td><?= $no ?></td>
                                        <td><?= $U['namaUser'] ?></td>
                                        <td><?= $U['username'] ?>
                                        </td>
                                        <td class="">
                                            <button type="button" class="btn btn-info btn-link" data-placement="bottom" title="Reset Password" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="resetButton('<?= $U['idUsers'] ?>','<?= $U['username'] ?>','<?= $U['namaUser'] ?>','<?= $U['role'] ?>')">
                                                <i class="material-icons">loop</i>
                                            </button>


                                            <button type="button" class="btn btn-danger btn-link" data-placement="bottom" title="Delete" data-bs-toggle="modal" data-bs-target="#exampleModal3" onclick="deleteButton('<?= $U['idUsers'] ?>','<?= $U['username'] ?>','<?= $U['namaUser'] ?>','<?= $U['role'] ?>')">
                                                <i class="material-icons">delete</i>
                                            </button>

                                        </td>
                                </tr>
                            <?php $no++;
                                    }  ?>
                        </div>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- USER -->



    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/users/save" method="POST" id='RegisterValidation'>
                    <input type="text" class="form-control" id="role" name="role" hidden value="1">
                    <div class="modal-body text-center">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password1" required equalTo='#password' name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>
    <!-- End  MOdal Tambah ADmin -->

    <!-- Reset PW admin -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/users/reset" method="POST">
                    <!-- <input type="text" class="form-control" id="role" name="role" hidden value="1"> -->
                    <input type="text" class="form-control" id="Rid" name="Rid" hidden>
                    <input type="text" class="form-control" id="Rrole" name="Rrole" hidden>

                    <div class="modal-body text-center">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="RnamaH" name="RnamaH" hidden>
                                    <input type="text" class="form-control" id="Rnama" name="Rnama" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="RusernameH" name="RusernameH" hidden>

                                    <input type="text" class="form-control" id="Rusername" name="Rusername" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p>Reset Password menjadi 123456</p>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>
    <!-- Reset PW ADmin -->

    <!-- Modal Delete ADmin  -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/users/delete" method="POST">
                    <!-- <input type="text" class="form-control" id="role" name="role" hidden value="1"> -->
                    <input type="text" class="form-control" id="Did" name="Did" hidden>
                    <input type="text" class="form-control" id="Drole" name="Drole" hidden>

                    <div class="modal-body text-center">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Dnama" name="Dnama" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <div class="form-group">

                                    <input type="text" class="form-control" id="Dusername" name="Dusername" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p>Delete </p>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>
    <!-- End Modal Delete ADmin -->

</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<script>
    function resetButton(id, username, namaUser, role) {
        $('#Rid').val(id);
        $('#Rusername').val(username);
        $('#RusernameH').val(username);
        $('#Rnama').val(namaUser);
        $('#RnamaH').val(namaUser);
        $('#Rrole').val(role);
    }

    function deleteButton(id, username, namaUser, role) {
        $('#Did').val(id);
        $('#Dusername').val(username);
        $('#DusernameH').val(username);
        $('#Dnama').val(namaUser);
        $('#DnamaH').val(namaUser);
        $('#Drole').val(role);
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

    $(document).ready(function() {
        $('#datatables2').DataTable({
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

        var table = $('#datatable2').DataTable();

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