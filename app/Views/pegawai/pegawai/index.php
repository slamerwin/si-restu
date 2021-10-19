<?= $this->extend('layout/index') ?>

<?= $this->section('judulbesarcontent') ?>
    <h1 class="h3 mb-2 text-gray-800">Pegawai</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <?php if(session()->get( 'level' ) == 1 || session()->get( 'level' ) == 2) {?>
        <button type="button" class="btn btn-sm btn-primary" id="btnTambah" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Data Pegawai </button>
        <br><br>
    <?php } ?>

    <?php if(session()->get( 'level' ) == 1 || session()->get( 'level' ) == 2) {?>
        <table class="table table-bordered" id="dataTablePegawai" width="100%" cellspacing="0">
    <?php } else { ?>
        <table class="table table-bordered" id="dataTablePegawai1" width="100%" cellspacing="0">
    <?php }  ?>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Status Aktif</th>
                    <?php if(session()->get( 'level' ) == 1 || session()->get( 'level' ) == 2) {?>
                        <th>Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>              
            </tbody>
        </table>
    </div>
</div>
<!-- Modal insert -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?php echo base_url('pegawai/savedata') ?>" method="post" id="tambahData" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Name" value="<?= old('username') ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= old('email') ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP" value="<?= old('nip') ?>">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" id="nohp" name="nohp" placeholder="No HP" value="<?= old('nohp') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update insert -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?php echo base_url('pegawai/updateData') ?>" method="post" id="ubahData" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username1" name="username1" placeholder="Name" value="<?= old('username') ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="email1" name="email1" placeholder="Email" value="<?= old('email') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nip1" name="nip1" placeholder="NIP" value="<?= old('nip') ?>">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" id="nohp1" name="nohp1" placeholder="No HP" value="<?= old('nohp') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?= base_url(); ?>/js/pegawai.js"></script>
<?= $this->endSection() ?>
