<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        <?= $title ?> | <?= $subTitle ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="<?= base_url() ?>/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url() ?>/assets/demo/demo.css" rel="stylesheet" />
    <?= $this->renderSection('head') ?>
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="rose" data-background-color="black" data-image="<?= base_url() ?>/assets/img/sidebar-1.jpg">


            <!-- Side Bar -->
            <?= $this->include('templates/sidebar') ?>
            <!-- End Side Bar -->
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <?= $this->include('templates/navbar') ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="content">
                    <?= $this->renderSection('page-content') ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">

                    <div class="copyright float-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, made by
                        <a href="https://www.instagram.com/ahdirmai" target="_blank">Ahdirmai</a> for a better web.
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <div class="modal fade" id="exampleModalX" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/users/updatePw" method="POST" id='RegisterValidation'>
                    <input type="text" class="form-control" id="idUsers" name="idUsers" hidden>
                    <input type="text" class="form-control" id="roleX" name="roleX" hidden>

                    <div class="modal-body text-center">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usernameX" name="usernameX" disabled>
                                    <input type="text" class="form-control" id="usernameZ" name="usernameZ" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="fullnameX" name="fullnameX">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="passwordX" name="passwordX">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password1" required equalTo='#passwordX' name="password_confirmation" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="profile('<?= session()->get('idUsers') ?>','<?= session()->get('username') ?>','<?= session()->get('namaUser') ?>', '<?= session()->get('password') ?>', <?= session()->get('role') ?>)">Close</button>
                            <button type="submit" class="btn btn-success" onclick="demo.showSwal('success-message')">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>



    <script>
        function profile(idUsers, username, namaUser, password, role) {
            $('#idUsers').val(idUsers);
            $('#usernameX').val(username);
            $('#usernameZ').val(username);
            $('#fullnameX').val(namaUser);
            $('#passwordX').val(password);
            $('#password1').val("");
            $('#roleX').val(role);
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
    </script>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>/assets/js/core/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="<?= base_url() ?>/assets/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="<?= base_url() ?>/assets/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="<?= base_url() ?>/assets/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?= base_url() ?>/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?= base_url() ?>/assets/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="<?= base_url() ?>/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="<?= base_url() ?>/assets/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="<?= base_url() ?>/assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?= base_url() ?>/assets/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="<?= base_url() ?>/assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="<?= base_url() ?>/assets/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?= base_url() ?>/assets/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="<?= base_url() ?>/assets/js/plugins/arrive.min.js"></script>

    <!-- Chartist JS -->
    <script src="<?= base_url() ?>/assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="<?= base_url() ?>/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url() ?>/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?= base_url() ?>/assets/demo/demo.js"></script>

    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();

            md.initVectorMap();

        });
        $(document).ready(function() {
            setFormValidation('#RegisterValidation');
            setFormValidation('#TypeValidation');
            setFormValidation('#LoginValidation');
            setFormValidation('#RangeValidation');
        });
        $('input[name=passwordX]').change(function() {
            $('#password1').removeAttr('disabled');
        });
    </script>

    <script>
        function readTextFile(file, callback) {
            var rawFile = new XMLHttpRequest();
            rawFile.overrideMimeType("application/json");
            rawFile.open("GET", file, true);
            rawFile.onreadystatechange = function() {
                if (rawFile.readyState === 4 && rawFile.status == "200") {
                    callback(rawFile.responseText);
                }
            }
            rawFile.send(null);
        }
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>