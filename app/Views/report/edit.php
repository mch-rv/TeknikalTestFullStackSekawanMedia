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
            <form method="post" action="<?= base_url('report/update/'.$report->id.'/'.$report->uid) ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="jenisMobil">Jenis Mobil</label>
                    <input type="text" class="form-control" id="jenisMobil" name="jenisMobil" value="<?= $report->jenisMobil ?>" />
                </div>

                <div class="form-group">
                    <label for="noPolisi">Nomor Polisi</label>
                    <input type="text" class="form-control" id="noPolisi" name="noPolisi" value="<?= $report->noPolisi ?>" />
                </div>

                <div class="form-group">
                    <label for="Driver">Driver</label>
                    <input type="text" class="form-control" id="Driver" name="Driver" value="<?= $report->Driver ?>" />
                </div>

                <div class="form-group">
                    <label for="tanggalPengajuan">Tanggal Pengajuan</label>
                    <input type="date" class="form-control" id="tanggalPengajuan" name="tanggalPengajuan" value="<?= date('Y-m-d',strtotime($report->tanggalPengajuan)) ?>" />
                </div>

                <div class="form-group">
                    <label for="tanggalPengembalian">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" id="tanggalPengembalian" name="tanggalPengembalian" value="<?= old('tanggalPengembalian') ?>" />
                </div>

                <div class="form-group">
                    <label for="BBM">Pemakaian BBM</label>
                    <input type="text" class="form-control" id="BBM" name="BBM" value="<?= old('BBM') ?>" />
                </div>

                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-info" />
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>