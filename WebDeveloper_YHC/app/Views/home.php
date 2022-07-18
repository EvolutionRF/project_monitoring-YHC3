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
<h6 class="m-0 font-weight-bold text-lg text-center">Project Monitoring</h6>
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
                    <tr class="align-middle">
                        <th style="width: 200px;">PROJECT NAME</th>
                        <th style="width: 200px;">CLIENT</th>
                        <th style="width: 300px; height:50px">PROJECT LEADER</th>
                        <th style="width: 120px;">START DATE</th>
                        <th style="width: 120px;">END DATE</th>
                        <th style="width: 250px;">PROGRESS</th>
                        <th style="width: 100px;">ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($project as $P) {
                    ?>

                        <tr class="align-middle">
                            <td><?= $P['nama_project'] ?></td>
                            <td><?= $P['client_project'] ?></td>
                            <td>
                                <div class="card border-0 small" style="width: 250px; height :50px">
                                    <div class="row g-0">
                                        <div class="col-auto mt-0">
                                            <img src="<?= base_url() ?>/img/<?= $P['foto_leader'] ?>" class="img-fluid rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div class="col-auto">
                                            <div class="card-body py-0" style="width:200; height : 70px">
                                                <h6 class="card-title"><?= $P['nama_leader'] ?></h6>
                                                <p class="card-text"><?= $P['email_leader'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?php $date = date_create($P['start_date']);
                                echo date_format($date, "d-M-Y") ?></td>
                            <td><?php $date = date_create($P['end_date']);
                                echo date_format($date, "d-M-Y") ?></td>
                            <td>
                                <div class="progress small">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $P['progress'] ?>%; background : 
                                    <?php
                                    if ($P['progress'] >= 100) {
                                        echo 'green';
                                    } elseif ($P['progress'] >= 75) {
                                        echo 'blue';
                                    } elseif ($P['progress'] >= 50) {
                                        echo 'magenta';
                                    } elseif ($p['progress'] >= 25) {
                                        echo 'orange';
                                    } else {
                                        echo 'red';
                                    }
                                    ?> 
                                    " aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><?= $P['progress'] ?>%</div>
                                </div>

                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#DeleteData" onclick="buttonDelete('<?= $P['id_project'] ?>','<?= $P['nama_project'] ?>','<?= $P['client_project'] ?>','<?= $P['id_leader'] ?>','<?= $P['start_date'] ?>','<?= $P['end_date'] ?>' ,'<?= $P['progress'] ?>')">
                                    <i class="fa fa-trash sm"></i></button>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#EditData" onclick="buttonEdit('<?= $P['id_project'] ?>','<?= $P['nama_project'] ?>','<?= $P['client_project'] ?>','<?= $P['id_leader'] ?>','<?= $P['start_date'] ?>','<?= $P['end_date'] ?>' ,'<?= $P['progress'] ?>')">
                                    <i class="fa fa-edit sm"></i></button>
                            </td>
                        </tr>
                    <?php
                    }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal  Tambah Data-->
<!-- Button trigger modal -->


<!-- Modal Tambah Data -->
<div class="modal fade" id="TambahData" tabindex="-1" aria-labelledby="Tambah Data" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="Tambah Data">Input Data Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/home/save" method="POST">
                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Project Name</label>
                        <input type="text" class="form-control" id="Project-name" name="Project-name" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Client Name</label>
                        <input type="text" class="form-control" id="Client-name" name="Client-name" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Project Leader</label>
                        <select class="form-select" aria-label="Default select example" name="id_Leader" required>
                            <option selected>Pilih Project Leader</option>
                            <?php
                            foreach ($leader as $L) {
                            ?>
                                <option value="<?= $L['id_leader'] ?>"><?= $L['nama_leader'] ?></option>
                            <?php
                            }  ?>
                        </select>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label" required>Start Date</label>
                        <input type="date" class="form-control" id="Start-Date" name="Start_date">
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label" required>End Date</label>
                        <input type="date" class="form-control" id="End-Date" name="End_date">
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="isChecked()">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Project Sudah dimulai?</label>
                    </div>

                    <div id="progress" hidden>
                        <label for="Project-progress" class="col-form-label">Progress</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukkan angka" aria-label="Username" aria-describedby="basic-addon1" name="progress">
                            <span class="input-group-text" id="basic-addon1">%</span>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <h5 class="modal-title text-center" id="Tambah Data">Edit Data Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/home/edit" method="POST">
                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Project Name</label>
                        <input type="text" class="form-control" id="UProject-name" name="UProject-name" required>
                    </div>
                    <input type="text" class="form-control" id="UId-Project" name="UId-Project" hidden>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Client Name</label>
                        <input type="text" class="form-control" id="UClient-name" name="UClient-name" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Project Leader</label>
                        <select class="form-select" aria-label="Default select example" name="Uid_Leader" id="Uid_Leader" required>
                            <option selected>Pilih Project Leader</option>
                            <?php
                            foreach ($leader as $L) {
                            ?>
                                <option value="<?= $L['id_leader'] ?>"><?= $L['nama_leader'] ?></option>
                            <?php
                            }  ?>
                        </select>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label" required>Start Date</label>
                        <input type="date" class="form-control" id="UStart-Date" name="UStart_date" required>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label" required>End Date</label>
                        <input type="date" class="form-control" id="UEnd-Date" name="UEnd_date" required>
                    </div>


                    <div id="progress">
                        <label for="Project-progress" class="col-form-label">Progress</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukkan angka" aria-label="Username" aria-describedby="basic-addon1" name="Uprogress" id="Uprogress" required>
                            <span class="input-group-text" id="basic-addon1">%</span>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Edit Data -->


<!-- Modal Delete Data -->
<div class="modal fade" id="DeleteData" tabindex="-1" aria-labelledby="Delete Data" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="Tambah Data">Delete Data Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/home/delete" method="POST">
                    <input type="text" class="form-control" id="DId-Project" name="DId-Project" hidden>
                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Project Name</label>
                        <input type="text" class="form-control" id="DProject-name" name="DProject-name" readonly>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Client Name</label>
                        <input type="text" class="form-control" id="DClient-name" name="DClient-name" readonly>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label">Project Leader</label>
                        <select class="form-select" aria-label="Default select example" name="Did_Leader" id="Did_Leader" disabled>
                            <option selected>Pilih Project Leader</option>
                            <?php
                            foreach ($leader as $L) {
                            ?>
                                <option value="<?= $L['id_leader'] ?>"><?= $L['nama_leader'] ?></option>
                            <?php
                            }  ?>
                        </select>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label" required>Start Date</label>
                        <input type="date" class="form-control" id="DStart-Date" name="DStart_date" readonly>
                    </div>

                    <div class="input-group-sm mb-3">
                        <label for="Project-name" class="col-form-label" required>End Date</label>
                        <input type="date" class="form-control" id="DEnd-Date" name="DEnd_date" readonly>
                    </div>



                    <div id="progress">
                        <label for="Project-progress" class="col-form-label">Progress</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukkan angka" aria-label="Username" aria-describedby="basic-addon1" name="Dprogress" id="Dprogress" readonly>
                            <span class="input-group-text" id="basic-addon1">%</span>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Data</button>
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

<!-- Is checked Funcition for Progress -->
<script>
    function isChecked() {
        if (document.getElementById('flexSwitchCheckDefault').checked) {
            $("#progress").removeAttr('hidden');
        } else {
            $("#progress").attr("hidden", true);
        }

    }
</script>


<!-- Button Edit Project -->
<script>
    function buttonEdit($id, $namaProject, $client_project, $id_leader, $start_date, $end_date, $progress) {
        $('#UId-Project').val($id);
        $('#UProject-name').val($namaProject);
        $('#UClient-name').val($client_project);
        $('#Uid_Leader').val($id_leader).change();
        $('#UStart-Date').val($start_date);
        $('#UEnd-Date').val($end_date);
        $('#Uprogress').val($progress);
    }
</script>

<!-- Button Delete Project -->
<script>
    function buttonDelete($id, $namaProject, $client_project, $id_leader, $start_date, $end_date, $progress) {
        $('#DId-Project').val($id);
        $('#DProject-name').val($namaProject);
        $('#DClient-name').val($client_project);
        $('#Did_Leader').val($id_leader).change();
        $('#DStart-Date').val($start_date);
        $('#DEnd-Date').val($end_date);
        $('#Dprogress').val($progress);
    }
</script>


<?= $this->endSection() ?>