<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>
        <div class="row  py-3 mt-1 align-items-center">
            <!-- For Demo Purpose -->
            <div class="col-md-6 pr-lg-1 mb-3 mb-md-0">
                <img src="<?= base_url(); ?>/img/login.png" alt="" class="img-fluid  d-none d-md-block">

            </div>
            <!-- Registeration Form -->
            <div class="col-lg-6">
                <h1>Forgot Password</h1>
                <p class="font-italic text-muted mb-0">Satu langkah lagi untuk mengubah password.</p>
                <br>
                    <div >
                        <form id="pas" method="post" action="<?= base_url('forgotpassword/ceng') ?>">
                        <input type="hidden" name="email" value="<?= $email ?>">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password New">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('registrasi') ?>">Create an Account!</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('') ?>">Already have an account? Login!</a>
                        </div>
                    </div>
            </div>
        </div>
<?= $this->endSection(); ?>