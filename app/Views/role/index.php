<?= $this->extend('layout/index') ?>

<?= $this->section('judulbesarcontent') ?>
    <h1 class="h3 mb-2 text-gray-800">User Role</h1>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Role</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTableRole" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>              
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?= base_url(); ?>/js/role.js"></script>
<?= $this->endSection() ?>
