<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">

                    <!--  <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Data User <a href="<?= base_url('admin/tambah-data-user') ?>" class="btn btn-success"><i class="fa fa-plus"></i></a></h1>
                        </div>
                    </div>-->
                    <!-- /.row -->
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
                                                <th>Pendidikan</th>
                                                <th>Tahun Penerimaan</th>
                                                <th>Action</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($data as $row): ?>
                                            <tr>
                                                <td style="width: 20px !important;" ><?= $i ?></td>
                                                <td><?= $row->nama ?></td>
                                                <td><?= $row->tempat_lahir.','.$row->tanggal_lahir?></td>
                                                <td><?= $row->alamat?></td>
                                                <td><?= $row->pendidikan ?></td>
                                                <td><?= $row->tahun_penerimaan ?></td>
                                                <td align="center">
                                                <a href="<?= base_url('manager/detail-pegawai/'.$row->username) ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Detail</a>
                                                <!-- <button class="btn btn-danger waves-effect"><i class="glyphicon glyphicon-trash"></i></button> -->
                                                </td>
                                               <!--  <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                        Aksi <span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                          <li><a href="<?= base_url('admin/edit-data-user/'.$row->nip) ?>"><i class="lnr lnr-pencil"></i> Edit</a></li>
                                                          <li><a href="<?= base_url('admin/detail-data-user/'.$row->nip) ?>"><i class="fa fa-eye"></i> Detail</a></li>
                                                          <li><a href="" onclick="delete_data()"><i class="lnr lnr-trash"></i> Hapus </a></li>
                                                        </ul>
                                                    </div>
                                                </td> -->
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
            </script>