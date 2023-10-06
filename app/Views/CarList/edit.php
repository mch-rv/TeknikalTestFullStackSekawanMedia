<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mb-5">
    <div class="card">
        <div class="card-header">
            <h3>Update Data</h3>
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
            <form method="post" action="<?= base_url('cars/update/'.$cars->id) ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="jadwalService">Jadwal Service</label>
                    <input type="date" placeholder="dd-mm-yyyy"  class="form-control" id="jadwalService" name="jadwalService" value="<?= $cars->jadwalService; ?>" />
                </div>

                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-info" />
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>