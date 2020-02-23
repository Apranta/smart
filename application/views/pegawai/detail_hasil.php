<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Hasil Penilaian Akhir</h4>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <style type="text/css">
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                    <h4 class="text-center">Penilaian Tes Tertuls</h4><hr>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>Nilai Tes</td>
                                            <td><?= ($this->Tes_tertulis_m->get_row(['id_pegawai' => $user->id_pegawai])) ? $this->Tes_tertulis_m->get_row(['id_pegawai' => $user->id_pegawai])->nilai : 0 ?> </td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <hr>
                                    <h4 class="text-center">Penilaian WAWANCARA</h4><hr>
                                    <style type="text/css">
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="3" valign="center" style="vertical-align: center !important;">Nama</th>
                                                <th colspan="<?= count($this->Kriteria_m->get()) + 2 ?>">Kriteria</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2">Domisili</th>
                                                <th rowspan="2">Nilai tes</th>
                                                <th colspan="<?= count($this->Kriteria_m->get()) ?>">Wawancara</th>
                                            </tr>
                                            <tr>
                                                
                                            <?php foreach ($this->Kriteria_m->get() as $kri): ?>
                                                    <th><?= $kri->nama ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $user->nama ?></td>
                                                <td><?= $this->Domisili_m->get_row(['id_pegawai' => $user->id_pegawai])->nilai ?></td>
                                                <td><?= $this->Tes_tertulis_m->get_row(['id_pegawai' => $user->id_pegawai])->nilai ?></td>
                                                <?php
                                                $total[$user->username] = 0;
                                                foreach ($this->Kriteria_m->get() as $kri): ?>
                                                    <th><?php 
                                                        $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $user->id_pegawai , 'id_kriteria' => $kri->id]);
                                                        if (!isset($nilai)) {
                                                            $total[$user->username]+=0;
                                                            echo "0";
                                                        }
                                                        else{
                                                            $val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->nilai : 0;
                                                            $total[$user->username]+=$val;
                                                            echo $val;
                                                        }
                                                    ?></th>
                                                <?php endforeach ?>
                                            </tr>
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