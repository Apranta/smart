<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Penilaian Pegawai
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <style type="text/css">
                        tr th,
                        tr td {
                            text-align: center;
                            padding: 1%;
                        }
                    </style>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="3" valign="center" style="vertical-align: center !important;">#</th>
                                <th rowspan="3" valign="center" style="vertical-align: center !important;">Nama</th>
                                <th colspan="<?= count($this->Kriteria_m->get()) + 2 ?>">Kriteria</th>
                                <th rowspan="3">Total</th>
                            </tr>
                            <tr>
                                <th rowspan="2">Domisili</th>
                                <th rowspan="2">Nilai tes</th>
                                <th colspan="<?= count($this->Kriteria_m->get()) ?>">Wawancara</th>
                            </tr>
                            <tr>

                                <?php foreach ($this->Kriteria_m->get() as $kri) : ?>
                                    <th><?= $kri->nama ?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($data as $pegawai) : 
                            $total_all[$pegawai->id_pegawai] = 0;
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $pegawai->nama ?></td>
                                    <td><?php
                                        $t = $this->Domisili_m->get_row(['id_pegawai' => $pegawai->id_pegawai])->nilai;
                                        $total_all[$pegawai->id_pegawai] += $t;
                                        echo $t;?> KM</td>
                                    <td><?php
                                     $s = $this->Tes_tertulis_m->get_row(['id_pegawai' => $pegawai->id_pegawai])->nilai;
                                     $total_all[$pegawai->id_pegawai] += $s; 
                                     echo $s;
                                     ?></td>
                                    <?php
                                    $total[$pegawai->id_pegawai] = 0;
                                    foreach ($this->Kriteria_m->get() as $kri) : ?>
                                        <td><?php
                                            $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->id_pegawai, 'id_kriteria' => $kri->id]);
                                            if (!isset($nilai)) {
                                                $total[$pegawai->id_pegawai] += 0;
                                                echo "0";
                                            } else {
                                                $val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->nilai : 0;
                                                $total[$pegawai->id_pegawai] += $val;
                                                echo $val;
                                            }
                                            ?></td>
                                    <?php endforeach ?>
                                    <td><?= $total[$pegawai->id_pegawai] + $total_all[$pegawai->id_pegawai] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    
                    <!-- /.table-responsive -->
                    <h4 class="text-center">Tabel Utiliti</h4>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="3" valign="center" style="vertical-align: center !important;">#</th>
                                <th rowspan="3" valign="center" style="vertical-align: center !important;">Nama</th>
                                <th colspan="<?= count($this->Kriteria_m->get()) + 2 ?>">Kriteria</th>
                                <th rowspan="3">Total</th>
                            </tr>
                            <tr>
                                <th rowspan="2">Domisili</th>
                                <th rowspan="2">Nilai tes</th>
                                <th colspan="<?= count($this->Kriteria_m->get()) ?>">Wawancara</th>
                            </tr>
                            <tr>

                                <?php foreach ($this->Kriteria_m->get() as $kri) : ?>
                                    <th><?= $kri->nama ?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($data as $pegawai) : 
                            $total[$pegawai->id_pegawai] = 0;
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $pegawai->nama ?></td>
                                    <td><?php 
                                            $dom = $this->Domisili_m->getUtiliti($pegawai->id_pegawai);
                                            $total[$pegawai->id_pegawai] += $dom;
                                            echo $dom;
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                            $tes = $this->Tes_tertulis_m->getUtiliti($pegawai->id_pegawai);
                                            $total[$pegawai->id_pegawai] += $tes;
                                            echo $tes;
                                        ?>
                                    </td>
                                    <?php
                                    $total_ww[$pegawai->id_pegawai] = 0;
                                    foreach ($this->Kriteria_m->get() as $kri) : ?>
                                        <td><?php
                                            $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->id_pegawai, 'id_kriteria' => $kri->id]);
                                            if (!isset($nilai)) {
                                                $total_ww[$pegawai->id_pegawai] += 0;
                                                echo "0";
                                            } else {
                                                $n_krit = $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai]);
                                                $val = $n_krit ? $n_krit->nilai : 0;

                                                //utiliti
                                                $uti = $this->Nilai_kriteria_m->getUtiliti($val , $kri->id);    
                                                $total_ww[$pegawai->id_pegawai] += $uti;
                                                echo $uti;
                                            }
                                            ?></td>
                                    <?php endforeach ?>
                                    <td><?= $total[$pegawai->id_pegawai] + $total_ww[$pegawai->id_pegawai] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <hr>
                    <h4 class="text-center">Tabel Hasil Akhir</h4>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="3" valign="center" style="vertical-align: center !important;">#</th>
                                <th rowspan="3" valign="center" style="vertical-align: center !important;">Nama</th>
                                <th colspan="3">Kriteria</th>
                                <th rowspan="3">Total</th>
                            </tr>
                            <tr>
                                <th rowspan="2">Domisili</th>
                                <th rowspan="2">Nilai tes</th>
                                <th colspan="">Wawancara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($data as $pegawai) : 
                            $total[$pegawai->id_pegawai] = 0;
                            ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $pegawai->nama ?></td>
                                    <td><?php 
                                            $dom = $this->Domisili_m->getUtiliti($pegawai->id_pegawai)* 0.2;
                                            $total[$pegawai->id_pegawai] += $dom;
                                            echo $dom;
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                            $tes = $this->Tes_tertulis_m->getUtiliti($pegawai->id_pegawai)* 0.3;
                                            $total[$pegawai->id_pegawai] += $tes;
                                            echo $tes ;
                                        ?>
                                    </td>
                                    <td>
                                    <?= ($total_ww[$pegawai->id_pegawai] / 4 ) * 0.5 ?></td>
                                    <td><?= $total[$pegawai->id_pegawai] + (($total_ww[$pegawai->id_pegawai] / 4 ) * 0.5) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.input-group.date').datepicker({
            format: "yyyy-mm-dd"
        });

        $('#dataTables-example').DataTable({
            responsive: true
        });
        $('#example').DataTable({
            responsive: true
        });
    });
</script>