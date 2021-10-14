<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>
        <div class="row  py-3 mt-1 align-items-center">
            <!-- For Demo Purpose -->
            <div class="col-md-6 pr-lg-1 mb-3 mb-md-0">
                <img src="<?= base_url(); ?>/img/uNGdWHi.png" alt="" class="img-fluid  d-none d-md-block">

            </div>
            <!-- Registeration Form -->
            <div class="col-lg-6">
                <h1>Registrasi</h1>
                <p class="font-italic text-muted mb-0">Masukan identitas, agar dapat masuk ke sistem.</p>
                <br>
                <div >
                    <form  id="reg" method="post" action="<?= base_url('registrasi/regis') ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Name" value="<?= old('username') ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= old('email') ?>">
                        </div>
                        <div class="form-group">
                            <select id="statusPegawai" name="statusPegawai" class="form-control form-control-user">
                                <option value="default">-- Status Pegawai --</option>
                                <option value="Tetap">Pegawai Tetap</option>
                                <option value="Hakim">Hakim</option>
                                <option value="Honor">Pegawai Honor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP" value="<?= old('nip') ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 ">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password">
                            </div>
                        </div>
                        <div id="tampung"></div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('') ?>">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
<?= $this->endSection(); ?>