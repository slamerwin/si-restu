<?= $this->extend('layout/index') ?>

<?= $this->section('judulbesarcontent') ?>
    <h1 class="h3 mb-2 text-gray-800">Surat Keputusan Aktif</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SK Aktif</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <?php if(session()->get( 'level' ) == 1 || session()->get( 'level' ) == 2) {?>
        <button type="button" class="btn btn-sm btn-primary" id="btnTambah" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Pembuatan SK </button>
        <br><br>
    <?php } ?>
    <?php if(session()->get( 'level' ) == 1 || session()->get( 'level' ) == 2) {?>
        <table class="table table-bordered" id="dataTableAktif" width="100%" cellspacing="0">
    <?php } else {?>
        <table class="table table-bordered" id="dataTableAktif1" width="100%" cellspacing="0">
    <?php } ?>
        
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SK</th>
                    <th>Tentang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>              
            </tbody>
        </table>
    </div>
</div>
<!-- Update insert -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat SK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?php echo base_url('permintaan/buatSK') ?>" method="post" id="buatDataPermintaan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nomor" name="nomor" placeholder="Nomor Surat" value="<?= old('nomor') ?>">
                    </div>
                    <div class="form-group">
                        <textarea rows="6" class="form-control form-control-user" id="tentang2" name="tentang2" placeholder="Tentang" value="<?= old('tentang2') ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <select class="selectpicker form-control form-control-user" id="petugas2" name="petugas2[]" data-live-search="true" multiple="multiple">
                            <?php foreach ($user as $key) {?>
                                 <option value="<?= $key['id'] ?>"><?= $key['nip'] ?> - <?= $key['username'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file"> Upload File  </label>
                        <input type="file" class="form-control form-control-user" id="file" name="file" multiple placeholder="File" >
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

<!-- Update insert -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Permintaan Pembutan SK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?php echo base_url('permintaan/updateDataSk') ?>" method="post" id="ubahDataSk" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="fileold" id="fileold">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nomor1" name="nomor1" placeholder="Nomor Surat" value="<?= old('nomor') ?>">
                    </div>
                    <div class="form-group">
                        <textarea rows="6" class="form-control form-control-user" id="tentang1" name="tentang1" placeholder="Tentang" value="<?= old('tentang1') ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <select class="selectpicker form-control form-control-user" id="petugas1" name="petugas1[]" data-live-search="true" multiple="multiple">
                            <?php foreach ($user as $key) {?>
                                 <option value="<?= $key['id'] ?>"><?= $key['nip'] ?> - <?= $key['username'] ?></option>
                            <?php } ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <select id="status" name="status" class="form-control form-control-user" value="<?= old('status') ?>">
                            <option value="Aktif" >Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-group" id="set">

                    </div>


                    <div class="form-group">
                        <label for="file"> Upload File  </label>
                        <input type="file" class="form-control form-control-user" id="file1" name="file1" multiple placeholder="File" >
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
<script src="<?= base_url(); ?>/js/aktifSK.js"></script>
<?= $this->endSection() ?>
