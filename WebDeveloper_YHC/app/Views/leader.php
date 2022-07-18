<?= $this->section('header') ?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">

<style>
    .btn-label {
        position: relative;
        left: -10px;
        display: inline-block;
        padding: 6px 12px;
        border-radius: 3px 0 0 3px;
    }

    .btn-labeled {
        padding-top: 0;
        padding-bottom: 0;
    }

    .btn {
        margin-bottom: 10px;
    }
</style>

<?= $this->endSection() ?>

<?= $this->extend('templates/layout') ?>

<?= $this->section('page-content') ?>
<h6 class="m-0 font-weight-bold text-lg text-center">Data Leader</h6>
<div class="text-end">
    <button type="button" class="btn btn-labeled btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#TambahData">
        <span class="btn-label"><i class="fa fa-plus sm"></i></span>Tambah Data</button>
</div>
<?php if (session()->getFlashdata('pesan')) { ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php } elseif (session()->getFlashdata('pesanDel')) { ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('pesanDel'); ?>
    </div>
<?php } elseif (session()->getFlashdata('pesanWarn')) { ?>
    <div class="alert alert-warning" role="alert">
        <?= session()->getFlashdata('pesanWarn'); ?>
    </div>
<?php }; ?>

<p class="mb-1"></p>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-borderless small font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Nama Leader</th>
                        <th>Email Leader</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1;
                    foreach ($leader as $L) {
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $L['nama_leader'] ?></td>
                            <td><?= $L['email_leader'] ?></td>
                            <td>
                                <img src="<?= base_url() ?>/img/<?= $L['foto_leader'] ?>" class="img-fluid rounded-pill" style="width: 70px; height: 70px; object-fit: cover;">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#DeleteData" onclick="buttonDelete('<?= $L['id_leader'] ?>','<?= $L['nama_leader'] ?>','<?= $L['email_leader'] ?>','<?= $L['foto_leader'] ?>')">
                                    <i class="fa fa-trash sm"></i></button>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#EditData" onclick="buttonEdit('<?= $L['id_leader'] ?>','<?= $L['nama_leader'] ?>','<?= $L['email_leader'] ?>','<?= $L['foto_leader'] ?>')">
                                    <i class="fa fa-edit sm"></i></button>
                            </td>
                        </tr>
                    <?php $no++;
                    }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<!-- Modal Tambah Data -->
<div class="modal fade" id="TambahData" tabindex="-1" aria-labelledby="Tambah Data" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="Tambah Data">Edit Data Leader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/leader/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="Leader-name" name="Leader-Name" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="Leader-Email" name="Leader-Email" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="File" class="form-label">Foto</label>
                        <br>
                        <img class="img-fluid img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;" id="preview" name="Leader-Foto">
                        <br>
                        <br>
                        <input class="form-control form-control-sm" id="Leader-Foto" type="file" accept="image/png, image/gif, image/jpeg" name="Leader-Foto" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah Data -->


<!-- Modal Edit Data -->
<div class="modal fade" id="EditData" tabindex="-1" aria-labelledby="Edit Data" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="Tambah Data">Input Data Leader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/leader/edit" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="text" class="form-control" id="ULeader-ID" name="ULeader-ID" hidden required>
                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="ULeader-Name" name="ULeader-Name" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="ULeader-Email" name="ULeader-Email" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="File" class="form-label">Foto</label>
                        <br>
                        <img class="img-fluid img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;" src=" " id="Upreview" name="ULeader-Foto">
                        <br>
                        <br>
                        <input class="form-control form-control-sm" id="ULeader-Foto" type="file" accept="image/png, image/gif, image/jpeg" name="ULeader-Foto" id="ULeader-Foto">
                    </div>
                    <input type="text" name="Edit_namaFile" id="Edit_namaFile" value="" hidden>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Edit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Edit Data -->


<!-- Modal Delete Data -->
<div class="modal fade" id="DeleteData" tabindex="-1" aria-labelledby="Tambah Data" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="Tambah Data">Delete Data Leader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/leader/delete" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="text" class="form-control" id="DLeader-ID" name="DLeader-ID" hidden>
                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="DLeader-Name" name="DLeader-Name" disabled>
                        <input type="text" class="form-control" id="DLeader-Name1" name="DLeader-Name1" hidden>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="DLeader-Email" name="DLeader-Email" disabled>
                        <input type="text" class="form-control" id="DLeader-Email1" name="DLeader-Email1" hidden>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="File" class="form-label">Foto</label>
                        <br>
                        <img class="img-fluid img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;" src=" " id="Dpreview" name="DLeader-Foto">
                        <br>
                        <br>
                    </div>
                    <input type="text" name="Delete_namaFile" id="Delete_namaFile" value="" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Modal Delete Data -->


<?= $this->endSection() ?>



<!-- Add Optional Script Here -->
<?= $this->section('footer') ?>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<script>
    $('input[type=file]').on('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0])
    })
</script>

<script>
    $('input[type=file]').on('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#Upreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0])
    })
</script>

<script>
    function buttonEdit($id, $namaLeader, $emailLeader, $fotoLeader) {
        $('#ULeader-ID').val($id);
        $('#ULeader-Name').val($namaLeader);
        $('#ULeader-Email').val($emailLeader);
        $('#Edit_namaFile').val($fotoLeader);
        document.getElementById('Upreview').src = '/img/' + $fotoLeader;
    }
</script>

<script>
    function buttonDelete($id, $namaLeader, $emailLeader, $fotoLeader) {
        $('#DLeader-ID').val($id);
        $('#DLeader-Name').val($namaLeader);
        $('#DLeader-Name1').val($namaLeader);
        $('#DLeader-Email').val($emailLeader);
        $('#DLeader-Email1').val($emailLeader);
        $('#Delete_namaFile').val($fotoLeader);
        document.getElementById('Dpreview').src = '/img/' + $fotoLeader;

    }
</script>



<?= $this->endSection() ?>