<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Papan Informasi</h3>
                </div>
                <div class="panel-body">
                    <?= form_open('admin/informasi'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Isi</label>
                                <textarea name="isi" class="form-control" rows="5"></textarea>
                            </div>
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </div>
                    </div>
                    <?= form_close(); ?>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach ($informasi as $value): ?>
                            
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= $value->judul ?></td>
                                <td><p><?= $value->isi ?></p></td>
                                <td>
                                    <a href="<?= base_url('admin/informasi?aksi=delete&id=' . $value->id_informasi) ?>"> Delete</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Kelulusan</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Penilaian Berkas</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach ($pegawai as $value): ?>
                                    <?php if ($value->berkas == 1): ?>
                                       <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $value->nama ?></td>
                                        </tr> 
                                    <?php endif ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <h4>Penilaian Tes</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach ($pegawai as $value): ?>
                                    <?php if ($value->tes == 1): ?>
                                       <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $value->nama ?></td>
                                        </tr> 
                                    <?php endif ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <h4>Penilaian Wawancara</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach ($pegawai as $value): ?>
                                    <?php if ($value->wawancara == 1): ?>
                                       <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $value->nama ?></td>
                                        </tr> 
                                    <?php endif ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>