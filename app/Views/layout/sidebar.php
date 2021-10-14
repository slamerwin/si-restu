        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div >
                    <img src="<?= base_url(); ?>/img/logo.png" width="25%" />
                    <div class="sidebar-brand-text mx-3">SI RESTU</div>
                </div>
                
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php if(session()->get( 'level' ) == 1|| session()->get( 'level' ) == 2 || session()->get( 'level' ) == 3) {?>
            <!-- Heading -->
            <div class="sidebar-heading">
                <br>
                Master Data
            </div>

            <!-- Pegawai -->
          
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-users"></i>
                        <span>Pegawai</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Master Pegawai:</h6>
                            <a class="collapse-item" href="<?= base_url('hakim'); ?>">Hakim</a>
                            <a class="collapse-item" href="<?= base_url('pegawai'); ?>">Pegawai</a>
                            <a class="collapse-item" href="<?= base_url('honor'); ?>">Pegawai Honor</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php if(session()->get( 'level' ) == 1) {?>
                <!-- Role User -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('role') ?>">
                        <i class="fas fa-users-cog"></i>
                        <span>Role User</span>
                    </a>
                </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                File Upload
            </div>

            <!-- Surat Keputusan -->
            <li class="nav-item ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseT"
                    aria-expanded="true" aria-controls="collapseT">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Surat Keputusan</span>
                </a>
                <div id="collapseT" class="collapse " aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Surat Keputusan</h6>
                        <a class="collapse-item" href="#">Aktif</a>
                        <a class="collapse-item" href="#">Tidak Aktif</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->