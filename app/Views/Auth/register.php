<?= $this->extend('Auth/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="post" action="/auth/daftar">
                <div class="card card-login card-hidden">
                    <div class="card-header card-header-rose text-center">
                        <h4 class="card-title">Register</h4>
                    </div>

                    <?php if (session()->getFlashdata('pesanLogin')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('pesanLogin'); ?>
                        </div>
                    <?php } ?>
                    <div class="card-body"> <span class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">person</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Fullname" name="fullname" id="fullname" required>
                            </div>
                        </span>
                        <span class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">person</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                            </div>
                        </span>
                        <span class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                            </div>
                        </span>
                        <span class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" id="password1" placeholder="Confirm Password" required equalTo='#password' name="password_confirmation">
                            </div>
                        </span>
                    </div>
                    <input type="text" hidden class="form-control" name="role" id="role" value="2">

                    <div class="card-footer justify-content-center">
                        <button type="submit" class="btn btn-rose btn-link btn-lg">Lets Go</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>