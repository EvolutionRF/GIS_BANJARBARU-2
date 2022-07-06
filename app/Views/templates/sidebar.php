<div class="logo">
    <a href="" class="simple-text logo-mini">
        DB
    </a>
    <a href="" class="simple-text logo-normal">
        Disporabudpar BJB
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<div class="sidebar-wrapper">
    <div class="user">
        <div class="photo">
            <?php if (session()->get('role') == '1') { ?>
                <img src="<?= base_url() ?>/assets/img/default-avatar-admin.jpg" />
            <?php } else { ?>
                <img src="<?= base_url() ?>/assets/img/default-avatar.png" />
            <?php } ?>

        </div>
        <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
                <span>
                    <?php if (session()->get('namaUser') == null) { ?>
                        Guess
                    <?php } else { ?>

                        <?= session()->get('namaUser'); ?>
                    <?php }; ?>
                    <b class="caret"></b>
                </span>
            </a>


            <?php if (session()->get('namaUser') == null) { ?>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">
                                <span class="sidebar-mini"><i class="material-icons">login</i> </span>
                                <span class="sidebar-normal"> Login </span>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php } else { ?>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalX" onclick="profile('<?= session()->get('idUsers') ?>','<?= session()->get('username') ?>','<?= session()->get('namaUser') ?>', '<?= session()->get('password') ?>', <?= session()->get('role') ?>)">
                                <span class="sidebar-mini"> <i class="material-icons">person</i> </span>
                                <span class="sidebar-normal"> My Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">
                                <span class="sidebar-mini"><i class="material-icons">logout</i> </span>
                                <span class="sidebar-normal"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php }; ?>




        </div>
    </div>
    <ul class="nav user">

        <?php if (session()->get('role') == '2') { ?>
            <li class="nav-item <?= ($title == 'User Fitur') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url() ?>/userF">
                    <i class="material-icons">person</i>
                    <p> User Fitur </p>
                </a>
            </li>
        <?php } else {
        ?>

        <?php } ?>



        <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url() ?>/">
                <i class="material-icons">dashboard</i>
                <p> Dashboard </p>
            </a>
        </li>

        <li class="nav-item  <?= ($title == 'Maps') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url() ?>/maps">
                <i class="material-icons">place</i>
                <p> Maps </p>
            </a>
        </li>

        <?php if (session()->get('role') == 1) { ?>
            <li class="nav-item  <?= ($title == 'Data Wisata') ? 'active' : '' ?> ">
                <a class="nav-link" href="<?= base_url() ?>/wisata">
                    <i class="material-icons">description</i>
                    <p> Data Wisata </p>
                </a>
            </li>

            <li class="nav-item  <?= ($title == 'Data Users') ? 'active' : '' ?> ">
                <a class="nav-link" href="<?= base_url() ?>/users">
                    <i class="material-icons">person</i>
                    <p> Data Users </p>
                </a>
            </li>

            <div class="devider"></div>

    </ul>
    <div class="user">
        <ul class="nav">
            <li class="nav-item">
                <p class="nav-link">
                    <span class="sidebar-normal">DATA MASTER </span>
                </p>
            </li>
            <li class="nav-item  <?= ($subTitle == 'Kode Pos') ? 'active' : '' ?> ">
                <a class="nav-link" href="<?= base_url() ?>/kode">
                    <span class="sidebar-normal"> Kode Pos </span>
                </a>
            </li>
            <li class="nav-item  <?= ($subTitle == 'Jenis Wisata') ? 'active' : '' ?>  ">
                <a class="nav-link" href="<?= base_url() ?>/jenis">
                    <span class="sidebar-normal"> Jenis Wisata</span>
                </a>
            </li>


            <li class="nav-item  <?= ($subTitle == 'Jam Operasional') ? 'active' : '' ?>  ">
                <a class="nav-link" href="<?= base_url() ?>/jam">
                    <span class="sidebar-normal"> Jam Operasional</span>
                </a>
            </li>

            <li class="nav-item  <?= ($subTitle == 'Fasilitas') ? 'active' : '' ?>  ">
                <a class="nav-link" href="<?= base_url() ?>/fasilitas">
                    <span class="sidebar-normal"> Fasilitas</span>
                </a>
            </li>
        </ul>
    </div>

<?php } else { ?>
<?php }; ?>



</div>