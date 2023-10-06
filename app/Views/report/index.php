<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<div class="container">
    <div class="card my-5">
        <div class="card-header">
            <h3>Report</h3>
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
                <form action="<?= base_url('report/export') ?>" method="post">
                        <div class="input-group ">
                        <?= csrf_field(); ?>
                            <button class="btn btn-primary" type="submit" name="submit">
                                <i class='bx bxs-file-export mr-1'></i>Export</button>
                        </div>
                    </form>
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
                    <th class="align-middle" rowspan="2">Driver</th>
                    <th class="align-middle" rowspan="2">Tanggal Pengajuan</th>
                    <th class="align-middle" rowspan="2">Tanggal Pengembalian</th>
                    <th class="align-middle" colspan="2">Approval</th>
                    <th class="align-middle" rowspan="2">Pemakaian BBM</th>
                    <th class="align-middle" rowspan="2">Action</th>
                </tr>
                <tr>
                    <th class="align-middle">Kepala Divisi</th>
                    <th class="align-middle">Manajer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $no  = 1 + (10 * ($currentPage - 1));
                        foreach ($report as $row) {
                        ?>
                            <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $row->jenisMobil; ?></td>
                            <td><?= $row->noPolisi; ?></td>
                            <td><?= $row->Driver; ?></td>
                            <td><?= $row->tanggalPengajuan; ?></td>
                            <td><?= $row->tanggalPengembalian; ?></td>
                            <td><?php if($row->headDivApprov==NULL){?>
                                <span>pending</span>
                                <?php } elseif($row->headDivApprov==1){?>
                                <i class='bx bx-check'></i>
                                <?php } else { ?>
                                <i class='bx bx-x'></i>
                                <?php } ?>
                            </td>
                            <td><?php if($row->managerApprov==NULL){?>
                                <span>pending</span>
                                <?php } elseif($row->managerApprov==1){?>
                                <i class='bx bx-check'></i>
                                <?php } else { ?>
                                <i class='bx bx-x'></i>
                                <?php } ?>
                            </td>
                            <td><?= $row->BBM; ?></td>
                            <?php if(session()->get('Role')=='Admin'){?>
                                <td>
                                <?php if(($row->managerApprov==1&&$row->headDivApprov==1)&&$row->tanggalPengembalian==NULL){ ?>
                                    <a href="<?= base_url('report/edit/'.$row->id.'/'.$row->uid); ?>" class="btn btn-sm btn-outline-primary mb-1">Finish</a>
                                <?php } ?>
                                <?php if(($row->managerApprov==NULL&&$row->headDivApprov==NULL)&&$row->tanggalPengembalian==NULL){ ?>
                                    <a href="<?= base_url('report/delete/'.$row->id.'/'.$row->uid) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" class="btn btn-sm btn-outline-danger">Delete</a>
                                <?php } ?>
                                </td>
                            <?php }?>
                            <?php if(session()->get('Role')=='HeadDiv'&&$row->headDivApprov==NULL){?>
                                <td>
                                <form method="post" action="<?= base_url('report/accept/'.$row->id) ?> " enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input  type="submit" value="accept" class="btn btn-sm btn-outline-primary mb-1" />
                                </form>
                                <form method="post" action="<?= base_url('report/reject/'.$row->id.'/'.$row->uid) ?> " enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input  type="submit" value="reject" class="btn btn-sm btn-outline-danger mb-1" />
                                </form>
                                </td>
                            <?php }?>
                            <?php if(session()->get('Role')=='Manager'&&$row->managerApprov==NULL){?>
                                <td>
                                <form method="post" action="<?= base_url('report/accept/'.$row->id) ?> " enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input  type="submit" value="accept" class="btn btn-sm btn-outline-primary mb-1" />
                                </form>
                                <form method="post" action="<?= base_url('report/reject/'.$row->id.'/'.$row->uid) ?> " enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input  type="submit" value="reject" class="btn btn-sm btn-outline-danger mb-1" />
                                </form>
                                </td>
                            <?php }?>
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