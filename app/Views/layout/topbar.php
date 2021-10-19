<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
    <?php  if(  session()->get( 'level' )==1||session()->get( 'level' )==2||session()->get( 'level' )==3) {?>
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="total"></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <?php  if(session()->get( 'level' )==1|| session()->get( 'level' )==2) {?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('permintaan/statusNotifPembuatan')?>">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <!-- <div class="small text-gray-500">December 12, 2019</div> -->
                        <span class="font-weight-bold">Permintaan Pembuatan SK</span>
                    </div>
                </a>
                <?php } ?>
                <?php  if( session()->get( 'level' )==1|| session()->get( 'level' )==3) {?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('permintaan/statusNotifTidakAktif')?>">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <span class="font-weight-bold">SK Tidak Aktif</span>
                </a>
                <?php } ?>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
    <?php } ?>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get( 'username' ) ?></span>
                <img class="img-profile rounded-circle"
                    src="<?= base_url() ?>/img/<?= session()->get( 'photo' ) ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('profile');?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('login/logout');?>"
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>