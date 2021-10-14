<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>
        <div class="row  py-3 mt-1 align-items-center">
            <!-- For Demo Purpose -->
            <div class="col-md-6 pr-lg-1 mb-3 mb-md-0">
                <img src="<?= base_url(); ?>/img/login (1).png" alt="" class="img-fluid  d-none d-md-block">

            </div>
            <!-- Registeration Form -->
            <div class="col-lg-6">
                <h1>Login</h1>
                <p class="font-italic text-muted mb-0">Masukan identitas, agar dapat masuk ke sistem.</p>
                <br>
                    <div >
                        <form id="log" method="post" action="<?= base_url('login/process') ?>">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('forgotpassword') ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('registrasi') ?>">Create an Account!</a>
                        </div>
                    </div>
            </div>
        </div>
<?= $this->endSection(); ?>