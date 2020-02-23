<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Data Pegawai
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <style type="text/css">
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>TTL</th>
                                                <th>Alamat</th>
                                                <!-- <th>Pendidikan</th> -->
                                                <th>Tahun Penerimaan</th>
                                                <th>Action</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($data as $row): ?>
                                            <tr>
                                                <td style="width: 10px !important;" ><?= $i ?></td>
                                                <td><?= $row->nama ?></td>
                                                <td><?= $row->tempat_lahir.','.$row->tanggal_lahir?></td>
                                                <td><?= $row->alamat?></td>
                                                <!-- <td><?= $row->pendidikan ?></td> -->
                                                <td><?= $row->tahun_penerimaan ?></td>
                                                <td align="center">
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('admin/detail-pegawai/'.$row->id_pegawai) ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                                        <!-- <a href="<?= base_url('admin/edit_profile/' . $row->id_pegawai) ?>" class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i></a> -->
                                                        <!-- <button class="btn btn-danger btn-xs" onclick="_delete('<?= $row->id_pegawai ?>');"><i class="glyphicon glyphicon-trash"></i></button> -->
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i++; endforeach; ?>
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

                function _delete(id) {
                    // body...
                    $.ajax({
                        url: "<?= base_url('admin/data-pegawai') ?>",
                        type: 'POST',
                        data: {
                            id: id,
                            delete: true
                        },
                        success: function() {
                            window.location = "<?= base_url('admin/data-pegawai') ?>";
                        }
                    });
                }
            </script>