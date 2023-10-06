<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Preview Data</h3>
        </div>
        <div class="card-body">
            <div class="px-4 my-2">
                <table class="table table-borderless table-responsive">
                    <tr>
                        <th>Jenis Mobil</th>
                        <th> : </th>
                        <td><?= $cars->jenisMobil; ?></td>
                    </tr>
                    <tr>
                        <th>No Polisi</th>
                        <th> : </th>
                        <td><?= $cars->noPolisi; ?></td>
                    </tr>
                    <tr>
                        <th>Jadwal Service</th>
                        <th> : </th>
                        <td><?= $cars->jadwalService; ?></td>
                    </tr>
                    <tr>
                        <th>Riwayat Pemakaian</th>
                        <th> : </th>
                        <td><?= $cars->riwayatPemakaian; ?></td>
                    </tr>
                    <tr>
                        <th>Ketersediaan</th>
                        <th> : </th>
                        <td><?= $cars->available? 'Tersedia':'Tidak tersedia' ?></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?= base_url('cars/request/'.$cars->id); ?>" class="btn btn-sm btn-outline-primary">Back</a>
                            <?php if(session()->get('Role')=='Admin'){?>
                                <a href="<?= base_url('cars/edit/'.$cars->id); ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a href="<?= base_url('cars/delete/'.$cars->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
                            <?php } ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


