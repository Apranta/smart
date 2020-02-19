<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Data Berkas</h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <style type="text/css">
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                        <table class="table">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama File</th>
                                                    <th>File (.pdf only)</th>
                                                    <th>Submit</th>
                                                </tr>
                                            <?php $i=0; foreach ($this->Berkas_m->get() as $value): ?>
                                                <?= form_open_multipart('pegawai/berkas'); ?>
                                                    <tr>
                                                        <th><?= ++$i ?></th>
                                                        <th><?= $value->nama ?></th>
                                                        <th>
                                                            <input type="file" name="file" class="form-control">
                                                            <input type="hidden" name="id" value="<?= $value->id_berkas ?>">
                                                        </th>
                                                        <th><input type="submit" name="upload" value="Submit" class="btn btn-success"></th>
                                                    </tr>
                                                <?= form_close(); ?>
                                            <?php endforeach ?>
                                        </table>
                                    <hr>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>Nama File</th>
                                                <th>Action</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key): ?>
                                            <tr>
                                                <td><?= $this->Berkas_m->get_row(['id_berkas' => $key->id_data_berkas])->nama ?></td>
                                                <td><a href="<?= base_url('assets/berkas/' . $key->id . '.pdf') ?>" class="btn btn-default">Download</a></td>
                                            </tr>
                                                
                                            <?php endforeach ?>
                                        </tbody> 
                                    </table>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>

            <script>
                $(document).ready(function() {
                    $('.input-group.date').datepicker({format: "yyyy-mm-dd"});
                    
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });
            </script>