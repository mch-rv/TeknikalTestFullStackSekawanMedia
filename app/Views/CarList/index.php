<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="container">
    <div class="card my-5">
        <div class="card-header">
            <h3>Car List</h3>
        </div>
        <div class="card-body">
            <div class="container">
            <?php if (!empty(session()->getFlashdata('message'))) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            </div>
            <?php if(session()->get('Role')=='Admin'){?>
            <div class="row justify-content-between my-2">
                <div class="col">
                    <a href="<?= base_url('cars/create'); ?>" class="btn btn-primary"><i class="fa-solid fa-square-plus mr-1"></i>Tambah</a>
                </div>
                <div class="col-4">
                    <form action="" method="post">
                        <div class="input-group ">
                        <?= csrf_field(); ?>
                            <input type="text" class="form-control" placeholder="Cari Data.." name="keyword">
                            <button class="btn btn-secondary" type="submit" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
                <hr />
            <?php }?>
                <div class="table-responsive">
            <table class="table table-bordered" >
                <thead>
                <tr class="text-center">
                    <th class="align-middle" rowspan="2">No</th>
                    <th class="align-middle" rowspan="2">Jenis Mobil</th>
                    <th class="align-middle" rowspan="2">No Polisi</th>
                    <th class="align-middle" rowspan="2">Jadwal Service</th>
                    <th class="align-middle" rowspan="2">Riwayat Pemakaian</th>
                    <th class="align-middle" rowspan="2">Ketersediaan</th>
                    <?php if(session()->get('Role')=='Admin'){?>
                    <th class="align-middle" rowspan="2">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                        $no  = 1 + (10 * ($currentPage - 1));
                        foreach ($cars as $row) {
                        ?>
                            <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $row->jenisMobil; ?></td>
                                <td><?= $row->noPolisi; ?></td>
                                <td><?= $row->jadwalService; ?></td>
                                <td><?= $row->riwayatPemakaian; ?></td>
                                <td><?= $row->available==1?'Tersedia':'Tidak Tersedia' ?></td>
                                <?php if(session()->get('Role')=='Admin'){?>
                                <td>
                                <?php if($row->available==1){?>
                                    <a href="<?= base_url('report/create/'.$row->id); ?>" class="btn btn-sm btn-outline-primary mb-1">Request</a>
                                <?php } else {?>
                                    <a href="<?= base_url('report/create/'.$row->id); ?>" class="btn btn-sm btn-outline-primary mb-1 disabled">Request</a>
                                <?php } ?>
                                    <a href="<?= base_url('cars/edit/'.$row->id); ?>" class="btn btn-sm btn-outline-secondary mb-1">Edit</a>
                                    <a href="<?= base_url('cars/delete/'.$row->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                                <?php } ?>
                            </tr>
                <?php
                }
                ?>
            </tbody>
            </table>
            </div>
            <?= $pager->links('Cars','Transhub'); ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<?= $this->endSection('content'); ?>