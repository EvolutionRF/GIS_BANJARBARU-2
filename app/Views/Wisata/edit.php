<?= $this->section('head') ?>

<script src="<?= base_url() ?>/leaflet/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css" />

<link rel="stylesheet" href="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="<?= base_url() ?>/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="<?= base_url() ?>/leaflet-routing-machine/examples/Control.Geocoder.js"></script>

<style>
    #maps {
        height: 400px;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->extend('templates/layout') ?>
<?= $this->section('page-content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="/wisata">
                <i class="material-icons">arrow_back</i>
            </a>
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">Edit Wisata
                        <small class="description">Nama Wisata</small>
                    </h4>
                </div>
                <div class="card-body ">
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
                    <div class="row">
                        <div class="col-md-2">
                            <ul class="nav nav-pills nav-pills-rose flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#link4" role="tablist">
                                        Data Wisata
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link5" role="tablist">
                                        Galery
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link6" role="tablist">
                                        Fasilitas
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-10">

                            <div class="tab-content">

                                <!-- Form Edit Data Wisata -->

                                <div class="tab-pane active" id="link4">
                                    <div class="card ">
                                        <div class="card-header card-header-rose card-header-text">
                                            <div class="card-text">
                                                <h4 class="card-title">Data Wisata</h4>
                                            </div>
                                        </div>
                                        <div class="card-body ">


                                            <!-- form Tambah -->
                                            <form method="POST" action="/wisata/update/<?= $detailW[0]['idWisata'] ?>" class="form-horizontal" id="TypeValidation" enctype="multipart/form-data">
                                                <fieldset id="all" disabled>

                                                    <?= csrf_field(); ?>
                                                    <input value="<?= $detailW[0]['idWisata'] ?>" name="idWisata" hidden />

                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Nama Wisata</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control <?= ($validation->hasError('namaWisata')) ? 'is-invalid' : ''; ?>" id="namaWisata" name="namaWisata" value="<?= $detailW[0]['namaWisata'] ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('namaWisata'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Alamat</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control <?= ($validation->hasError('alamatWisata')) ? 'is-invalid' : ''; ?>" id="alamatWisata" name="alamatWisata" value="<?= $detailW[0]['alamatWisata'] ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('alamatWisata'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Kelurahan</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">

                                                                <select class="selectpicker <?= ($validation->hasError('kodePos')) ? 'is-invalid' : ''; ?>" data-size="7" data-style="select-with-transition" title="Single Select" id="kodePos" name="kodePos">
                                                                    <?php $no = 1;
                                                                    foreach ($kodePos as $kP) {
                                                                    ?>
                                                                        <option <?= ($kP['idkodePos'] == $detailW[0]['idkodePos']) ? 'Selected' : '' ?> value="<?= $kP['idkodePos'] ?>"><?= $kP['kelurahan'] ?> </option>

                                                                    <?php
                                                                    }  ?>

                                                                </select>

                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('kodePos'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Kontak Person</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <input class="form-control <?= ($validation->hasError('cp')) ? 'is-invalid' : ''; ?>" minLength="11" type="text" name="cp" id="cp" value="<?= $detailW[0]['cpWisata'] ?>" />
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('cp'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" row">
                                                        <label class="col-sm-2 col-form-label">Titik Koordinat</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label for="latitude" class="bmd-label-floating">Latitude</label>
                                                                                <input type="text" class="form-control <?= ($validation->hasError('latitude')) ? 'is-invalid' : ''; ?>" id="latitude" name="latitude" value="<?= $detailW[0]['latWisata'] ?>" number='true'>

                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('latitude'); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label for="latitude" class="bmd-label-floating">Longitude</label>
                                                                                <input type="text" class="form-control <?= ($validation->hasError('longitude')) ? 'is-invalid' : ''; ?>" id="longitude" name="longitude" value="<?= $detailW[0]['longWisata'] ?>" number='true'>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('longitude'); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-info btn-sm" type="button" onclick="setMap()" id="pilih" name="pilih">Pilih Dipeta</button>
                                                                        <button class="btn btn-primary btn-sm" type="button" onclick="setMap2()" id="done" name="Done" hidden>Done</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div id="maps" hidden></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Jenis Wisata</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <select class="selectpicker <?= ($validation->hasError('jenisWisata')) ? 'is-invalid' : ''; ?>" data-size="7" data-style="select-with-transition" title="Single Select" id="jenisWisata" name="jenisWisata">
                                                                    <?php
                                                                    foreach ($jenisWisata as $jW) {
                                                                    ?>
                                                                        <option <?= ($jW['idjenisWisata'] == $detailW[0]['idjenisWisata']) ? 'Selected' : '' ?> value="<?= $jW['idjenisWisata'] ?>"><?= $jW['namaJenisWisata'] ?></option>

                                                                    <?php
                                                                    }  ?>
                                                                </select>

                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jenisWisata'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <textarea class="form-control <?= ($validation->hasError('desc')) ? 'is-invalid' : ''; ?>" id="desc" name="desc"> <?= $detailW[0]['deskripsiW'] ?></textarea>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('desc'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label class="col-sm-2 col-form-label">Jam Operasional</label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <select class="selectpicker " data-size="7" data-style="select-with-transition" title="Single Select" id="idJam" name="idJam">
                                                                    <?php
                                                                    foreach ($jamWisata as $jam) {
                                                                    ?>
                                                                        <option value="<?= $jam['idJam'] ?>" <?= ($detailW[0]['idJam'] == $jam['idJam']) ? 'selected' : '' ?>><?= $jam['jamBuka'] ?> -<?= $jam['jamTutup'] ?> </option>

                                                                    <?php
                                                                    }  ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-info" id="editW" onclick="editButton()">Edit</button>
                                                    <button type="button" class="btn btn-warning" id="cancelW" onclick="cancelButton()" style="display: none;">Cancel</button>
                                                    <button type="submit" class="btn btn-rose" id="saveW" style="display: none;">Save</button>
                                                </div>
                                            </form>


                                            <!-- form tambah -->

                                            <!-- form edit -->


                                            <!-- form edit -->
                                            <script>
                                                function editButton() {
                                                    $('#editW').hide();
                                                    $('#cancelW, #saveW').show();

                                                    $("#all").prop("disabled", false);

                                                }

                                                function cancelButton() {
                                                    $('#editW').show();
                                                    $('#cancelW, #saveW').hide();
                                                    $("#all").prop("disabled", true);


                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Data Wisata -->

                                <!-- Form Galery -->
                                <div class="tab-pane" id="link5">
                                    <div class="row">
                                        <?php $idx = 0;
                                        $namafile = "";
                                        // dd($galeriW);
                                        foreach ($galeriW as $gW) {
                                            // dd($gW);
                                        ?>
                                            <div class="col-md-4">
                                                <div class="card card-product">
                                                    <div class="card-header card-header-image">
                                                        <a href="">
                                                            <img class="img" src="<?= base_url() ?>/assets/img/wisata/<?= $gW['namafile'] ?>">
                                                        </a>
                                                    </div>

                                                    <?php $namafile = 'ngalihnya';
                                                    // dd($gW['namaTable']);
                                                    // dd($namafile);
                                                    // dd($gW);
                                                    ?>
                                                    <div class="card-body text-center">

                                                        <button type="button" class="btn btn-success btn-link" data-placement="bottom" title="Edit" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setEdited(<?= $gW['idgaleri']; ?>,'<?= $gW['namafile']; ?>', <?= $detailW[0]['idWisata'] ?>) ">
                                                            <i class="material-icons">edit</i>
                                                        </button>



                                                        <button type="button" class="btn btn-danger btn-link" data-placement="bottom" title="Remove" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="setRemove(<?= $gW['idgaleri'] ?>,<?= $detailW[0]['idWisata'] ?>)">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }  ?>
                                    </div>


                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3"> Tambah Foto</button>
                                    </div>
                                </div>
                                <!-- End Form Galery -->

                                <!-- Fasilitas -->
                                <!-- Tambah -->
                                <div class="tab-pane" id="link6">
                                    <!-- <?php d($fasilitasWisata) ?> -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header card-header-primary card-header-icon">

                                                    <h4 class="card-title">Fasilitas Wisata</h4>

                                                </div>
                                                <div class="card-body">
                                                    <div class="toolbar">
                                                        <button type="button" class="btn btn-primary" data-placement="bottom" title="Tambah" data-bs-toggle="modal" data-bs-target="#tambahFasilitasWisata">Tambah Data
                                                        </button>
                                                    </div>
                                                    <div class="material-datatables">
                                                        <div class="devider"></div>
                                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">

                                                            <thead>
                                                                <tr>
                                                                    <th class="disabled-sorting ">No</th>
                                                                    <th class="disabled-sorting ">Nama Fasilitas</th>
                                                                    <th class="disabled-sorting ">Keterangan</th>
                                                                    <th class="disabled-sorting ">Actions</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                                <?php $no = 1;
                                                                foreach ($fasilitasWisata as $Fw) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $no ?></td>
                                                                        <td><?= $Fw['namaFasilitas'] ?></td>
                                                                        <td><?= $Fw['keteranganF'] ?></td>

                                                                        <td class="">
                                                                            <button type="button" class="btn btn-success btn-link" data-placement="bottom" title="Edit" data-bs-toggle="modal" data-bs-target="#editFasilitasWisata" onclick="buttonEdit('<?= $Fw['id_fasilitas_wisata'] ?>','<?= $Fw['idFasilitas'] ?>','<?= $Fw['keteranganF'] ?>')">
                                                                                <i class="material-icons">edit</i>
                                                                            </button>

                                                                            <button type="button" class="btn btn-danger btn-link" data-placement="bottom" title="Remove" data-bs-toggle="modal" data-bs-target="#deleteFasilitasWisata" onclick="buttonDelete('<?= $Fw['id_fasilitas_wisata'] ?>','<?= $Fw['idFasilitas'] ?>','<?= $Fw['keteranganF'] ?>')">
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
                                <!-- Fasilitas -->

                                <!-- Modal GALERY -->

                                <!-- edit -->

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Gambar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/wisata/updateImgW" enctype="multipart/form-data" method="POST">
                                                <div class="modal-body text-center">
                                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail">
                                                            <input type="text" name="Edit_idGaleri" id="Edit_idGaleri" hidden value="">
                                                            <input type="text" name="Edit_idWisataX" id="Edit_idWisataX" hidden value="">
                                                            <input type="text" name="Edit_namaFile" id="Edit_namaFile" value="" hidden>
                                                            <img src="/" id="imgEdit" name="imgEdit">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                        <div>
                                                            <span class="btn btn-rose btn-round btn-file">
                                                                <span class="fileinput-new">Ganti Foto</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" id="editImg" name="editImg" />
                                                            </span>
                                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
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
                                </div>
                                <!-- edit -->

                                <!-- Tambah gambar -->
                                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/wisata/addImgW" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body text-center">
                                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail">
                                                            <img src="<?= base_url() ?>/assets/img/image_placeholder.jpg" alt="...">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                        <div>
                                                            <span class="btn btn-rose btn-round btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="text" name="idWisata" id="wisata" value="<?= $detailW[0]['idWisata'] ?>" hidden>
                                                                <input type="file" name="fotoWisata" id="fotoWisata" />
                                                            </span>
                                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tambah gambar -->

                                <!-- Delete Gambar -->
                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Gambar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/wisata/removeImg" method="POST">
                                                <input type="text" name="idGaleri" id="idGaleri" hidden value="">
                                                <input type="text" name="idWisataX" id="idWisataX" hidden value="">
                                                <div class="modal-body text-center">
                                                    <p>Apakah anda yakin ingin menghapus gambar ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete!</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete Gambar -->


                                <!-- Modal Fasilitas Wisata -->
                                <!-- Tambah Fasilitas -->
                                <div class="modal fade" id="tambahFasilitasWisata" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Tambah Fasilitas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="/wisata/addFasilitas" method="POST" id="TypeValidation">
                                                <div class="modal-body text-center">
                                                    <input type="text" name="idWisata" id="wisata" value="<?= $detailW[0]['idWisata'] ?>" hidden>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Fasilitas</label>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Single Select" id="fasilitas" name="fasilitas">
                                                                    <option disabled selected value="">Pilih Fasilitas</option>
                                                                    <?php $no = 1;
                                                                    foreach ($fasilitas as $F) {
                                                                    ?>
                                                                        <option value="<?= $F['idFasilitas'] ?>"><?= $F['namaFasilitas'] ?></option>

                                                                    <?php
                                                                    }  ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="keteranganF" name="keteranganF" required>
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
                                <!-- End Tambah Fasilitas -->

                                <!-- Edit Fasilitas Wisata -->
                                <div class="modal fade" id="editFasilitasWisata" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Edit Fasilitas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="/wisata/updateFasilitas" method="POST" id="TypeValidation">
                                                <div class="modal-body text-center">
                                                    <input type="text" name="idWisata" id="wisata" value="<?= $detailW[0]['idWisata'] ?>" hidden>
                                                    <input type="text" name="idFW" id="idFW" hidden>
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Fasilitas</label>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Single Select" id="Ufasilitas" name="Ufasilitas">
                                                                    <option disabled selected value="">Pilih Fasilitas</option>
                                                                    <?php $no = 1;
                                                                    foreach ($fasilitas as $F) {
                                                                    ?>
                                                                        <option value="<?= $F['idFasilitas'] ?>"><?= $F['namaFasilitas'] ?></option>

                                                                    <?php
                                                                    }  ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="UketeranganF" name="UketeranganF" required>
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
                                <!-- ENd Edit Fasilitas Wisata -->

                                <!-- Delete Fasilitas Wisata -->
                                <div class="modal fade" id="deleteFasilitasWisata" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Edit Fasilitas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="/wisata/deleteFasilitas" method="POST" id="TypeValidation">
                                                <div class="modal-body text-center">
                                                    <input type="text" name="DidFW" id="DidFW" hidden>
                                                    <input type="text" name="idWisata" id="wisata" value="<?= $detailW[0]['idWisata'] ?>" hidden>

                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Fasilitas</label>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Single Select" id="Dfasilitas" name="Dfasilitas" disabled>
                                                                    <option disabled selected value="">Pilih Fasilitas</option>
                                                                    <?php $no = 1;
                                                                    foreach ($fasilitas as $F) {
                                                                    ?>
                                                                        <option value="<?= $F['idFasilitas'] ?>"><?= $F['namaFasilitas'] ?></option>

                                                                    <?php
                                                                    }  ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="DketeranganF" name="DketeranganF" disable>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <p>Delete Fasilitas yang dipilih</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- End Delete Fasilitas Wisata -->


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<script>
    function buttonEdit($idFw, $idF, $ketF) {
        $('#Ufasilitas').val($idF).change();
        $('#UketeranganF').val($ketF);
        $('#idFW').val($idFw);
    }

    function buttonDelete($DidFw, $DidF, $DketF) {
        $('#Dfasilitas').val($DidF).change();
        $('#DketeranganF').val($DketF);
        $('#DidFW').val($DidFw);
    }
</script>


<script>
    function setMap() {
        $('#maps').removeAttr('hidden');
        setTimeout(function() {
            map.invalidateSize();
        }, 10);
        $("#pilih").attr("hidden", true);
        $("#done").removeAttr('hidden');
    }

    function setMap2() {
        $("#pilih").removeAttr('hidden');
        $("#maps").attr("hidden", true);
        $("#done").attr("hidden", true);
    }
</script>
<script>
    $(document).ready(function() {
        // initialise Datetimepicker and Sliders
        md.initFormExtendedDatetimepickers();
        if ($('.slider').length != 0) {
            md.initSliders();
        }
    });
</script>
<script>
    function setRemove($id, $idX) {
        $('#idGaleri').val($id);
        $('#idWisataX').val($idX);
    }

    function setEdited($id_E, $image, $idX_E) {
        $('#Edit_idGaleri').val($id_E);
        $('#Edit_idWisataX').val($idX_E);
        $('#Edit_namaFile').val($image);
        document.getElementById('imgEdit').src = <?php base_url() ?> '/assets/img/wisata/' + $image;

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
</script>

<script>
    let latLng = [-3.457242, 114.810318];
    var map = L.map('maps').setView(
        latLng, 15);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);


    map.attributionControl.setPrefix(false);

    var marker = new L.marker({
        lat: -3.45700,
        lon: 114.810318
    }, {
        draggable: 'true'
    });
    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        console.log(position);
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        $("#latitude").val(position.lat).keyup();
        $("#longitude").val(position.lng).keyup();
    });

    $("#latitude,#longitude").change(function() {
        var position = [$("#latitude").val(), $("#longitude").val()];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
    });
    marker.addTo(map);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>





<?= $this->endSection() ?>