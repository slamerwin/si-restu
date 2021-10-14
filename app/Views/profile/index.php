<?= $this->extend('layout/index') ?>

<?= $this->section('judulbesarcontent') ?>
    <h1 class="h3 mb-2 text-gray-800">Profile</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="<?= base_url(); ?>/img/<?= $photo ?>">
                    <span class="font-weight-bold"><?= $username ?></span><span class="text-black-50"><?= $email ?></span>
                    <span> </span>
                </div>
            </div>
            <div class="col-md-8 ">
                <div class="col-md-6 ">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <form  id="profile" method="post" action="<?= base_url('profile/updateProfile') ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Name" value="<?= $username ?>">
                            </div>
                            <div class="form-group">
                                <select id="statusPegawai" name="statusPegawai" class="form-control form-control-user" value="<?= $statuspegawai ?>">
                                    <option value="default" >-- Status Pegawai --</option>
                                    <option value="Tetap" <?= $statuspegawai == 'Tetap' ? "selected" : null ?>>Pegawai Tetap</option>
                                    <option value="Hakim" <?= $statuspegawai == 'Hakim' ? "selected" : null ?>>Hakim</option>
                                    <option value="Honor" <?= $statuspegawai == 'Honor' ? "selected" : null ?>>Pegawai Honor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP" value="<?= $nip ?>">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="nohp" name="nohp" placeholder="NO HP" value="<?= $nohp ?>">
                            </div>
                            <div class="form-group">
                                <label for="photo"> Photo </label>
                                <input type="file" class="form-control form-control-user" id="photo" name="photo" multiple placeholder="Photo" >
                            </div>
                            <input type="hidden" name= "userid" value= <?= $userid ?>>
                            <div id="tampung"></div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
