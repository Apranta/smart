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
                                                <?php foreach ($this->Nilai_tes_m->get() as $value): ?>
                                                    
                                                <th><?= $value->nama ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($this->Nilai_tes_m->get() as $value): ?>
                                                    <td><?= ($this->Tes_tertulis_m->get_row(['id_pendaftar' => $username , 'id_nilai' => $value->id_nilai])) ? $this->Tes_tertulis_m->get_row(['id_pendaftar' => $username , 'id_nilai' => $value->id_nilai])->nilai : 0 ?> </td>
                                                <?php endforeach ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h4 class="text-center">Penilaian WAWANCARA</h4><hr>
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
                                            <tr>
                                                <td>1</td>
                                                <td><?= $user->nama ?></td>
                                                <?php
                                                $total = 0;
                                                foreach ($this->Kriteria_m->get() as $kri): ?>
                                                    <th><?php 
                                                        $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $user->username , 'id_kriteria' => $kri->id]);
                                                        if (!isset($nilai)) {
                                                            $total+=0;
                                                            echo "0";
                                                        }
                                                        else{
                                                            $val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->bobot : 0;
                                                            $total+=$val;
                                                            echo $val;
                                                        }
                                                    ?></th>
                                                <?php endforeach ?>
                                                <td><?= $this->Penilaian_m->Total($user->username)->total ?></td>
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