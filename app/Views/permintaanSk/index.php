<?= $this->extend('layout/index') ?>

<?= $this->section('judulbesarcontent') ?>
    <h1 class="h3 mb-2 text-gray-800">Permintaan Pembuatan SK</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <?php if(session()->get( 'level' ) == 1 || session()->get( 'level' ) == 3) {?>
        <button type="button" class="btn btn-sm btn-primary" id="btnTambah" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Pembuatan SK </button>
        <br><br>
    <?php } ?>
    <?php if(session()->get( 'level' ) == 1 || session()->get( 'level' ) == 3) {?>
        <table class="table table-bordered" id="dataTablePermintaan" width="100%" cellspacing="0">
    <?php }else{ ?>
        <table class="table table-bordered" id="dataTablePermintaan1" width="100%" cellspacing="0">
    <?php } ?>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tentang</th>
                    <th>Aksi</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Permintaan Pembutan SK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?php echo base_url('permintaan/saveData') ?>" method="post" id="tambahDataPermintaan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <textarea rows="6" class="form-control form-control-user" id="tentang" name="tentang" placeholder="Tentang" value="<?= old('tentang') ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <select class="selectpicker form-control form-control-user" id="petugas" name="petugas[]" data-live-search="true" multiple="multiple">
                            <?php foreach ($user as $key) {?>
                                 <option value="<?= $key['id'] ?>"><?= $key['nip'] ?> - <?= $key['username'] ?></option>
                            <?php } ?>
                        </select>

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
            <form  action="<?php echo base_url('permintaan/updateData') ?>" method="post" id="ubahDataPermintaan" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <textarea rows="6" class="form-control form-control-user" id="tentang1" name="tentang1" placeholder="Tentang" value="<?= old('tentang') ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <select class="selectpicker form-control form-control-user" id="petugas1" name="petugas1[]" data-live-search="true" multiple="multiple">
                            <?php foreach ($user as $key) {?>
                                 <option value="<?= $key['id'] ?>"><?= $key['nip'] ?> - <?= $key['username'] ?></option>
                            <?php } ?>
                        </select>

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
<!-- Lihat -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rekomendasi Pembuatan SK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Tentang  :</h5>
                <div id="tentang">
                <p ></p>
                </div>
                <h5>Petugas  :</h5>
                <ol></ol>
            </div>
            
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?= base_url(); ?>/js/permintaan.js"></script>
<?= $this->endSection() ?>
