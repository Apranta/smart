<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Laporan Penilaian Calon Pegawai</h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <style type="text/css">
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" valign="center" style="vertical-align: center !important;">#</th>
                                                <th rowspan="2" valign="center" style="vertical-align: center !important;">Nama</th>
                                                <th colspan="<?= count($this->Kriteria_m->get()) ?>">Kriteria</th>
                                                <th rowspan="2">Total</th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($this->Kriteria_m->get() as $kri): ?>
                                                    <th><?= $kri->nama ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0; foreach ($data as $pegawai): ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $pegawai->nama ?></td>
                                                <?php
                                                $total[$pegawai->username] = 0;
                                                foreach ($this->Kriteria_m->get() as $kri): ?>
                                                    <th><?php 
                                                        $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->username , 'id_kriteria' => $kri->id]);
                                                        if (!isset($nilai)) {
                                                            $total[$pegawai->username]+=0;
                                                            echo "0";
                                                        }
                                                        else{
                                                            $val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->bobot : 0;
                                                            $total[$pegawai->username]+=$val;
                                                            echo $val;
                                                        }
                                                    ?></th>
                                                <?php endforeach ?>
                                                <td><?= $total[$pegawai->username] ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive -->
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-primary">Print Laporan</button>
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