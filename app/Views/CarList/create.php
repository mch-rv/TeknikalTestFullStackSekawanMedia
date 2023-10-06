<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Data</h3>
        </div>
        <div class="card-body">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url('cars/store') ?> " enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="jenisMobil">Jenis Mobil</label>
                    <input type="text" class="form-control" id="jenisMobil" name="jenisMobil" value="<?= old('jenisMobil') ?>" />
                </div>

                <div class="form-group">
                    <label for="noPolisi">Nomor Polisi</label>
                    <input type="text" class="form-control" id="noPolisi" name="noPolisi" value="<?= old('noPolisi') ?>" />
                </div>

                <div class="form-group">
                    <label for="jadwalService">Jadwal Service</label>
                    <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="jadwalService" name="jadwalService" value="<?= old('jadwalService') ?>" />
                </div>

                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-info" />
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>