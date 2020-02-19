<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
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
                                                <?php foreach ($this->Nilai_tes_m->get() as $e): ?>
                                                    <th><?= $e->nama ?></th>
                                                <?php endforeach ?>
                                                <th>Total</th>
                                                <th>Action</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($data as $row): 
                                                $total = 0;
                                            ?>
                                            <tr>
                                                <td style="width: 20px !important;" ><?= $i ?></td>
                                                <td><?= $row->nama ?></td>
                                                
                                                <?php foreach ($this->Nilai_tes_m->get() as $e): ?>
                                                    <td><?php
                                                     $nilai =  $this->Tes_tertulis_m->get_row(['id_pendaftar' => $row->username , 'id_nilai' => $e->id_nilai]) ? $this->Tes_tertulis_m->get_row(['id_pendaftar' => $row->username , 'id_nilai' => $e->id_nilai])->nilai : 0 ;
                                                        $total+=$nilai;
                                                        echo $nilai;
                                                     ?></td>
                                                <?php endforeach ?>
                                                <td><?= $total ?></td>
                                                <td align="center">
                                                    <?php if ($row->tes == 1): ?>
                                                        <button class="btn btn-danger" onclick="batal('<?= $row->username ?>')">TIDAK DITERIMA</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-success" onclick="lulus('<?= $row->username ?>')"> DITERIMA</button>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- <div class="panel-footer">
                                    <button type="button" class="btn btn-lg btn-info" onclick="_submit()">Submit Nilai</button>
                                </div> -->
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
                function lulus(username) {
                    // alert('aa');
                    $.ajax({
                            url: "<?= base_url('manager/tes-tertulis') ?>",
                            type: 'POST',
                            data: {
                                username: username,
                                konfirm: true
                            },
                            success: function() {
                                window.location = "<?= base_url('manager/tes-tertulis') ?>";
                            }
                        });
                }

                function batal(username) {
                    // alert('aa');
                    $.ajax({
                            url: "<?= base_url('manager/tes-tertulis') ?>",
                            type: 'POST',
                            data: {
                                username: username,
                                notkonfirm: true
                            },
                            success: function() {
                                window.location = "<?= base_url('manager/tes-tertulis') ?>";
                            }
                        });
                }
            </script>