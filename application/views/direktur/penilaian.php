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
                                    <hr>
                                    <h4 class="text-center">Tabel Utiliti</h4>
                                    <hr>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" valign="center" style="vertical-align: center !important;">#</th>
                                                <th rowspan="2" valign="center" style="vertical-align: center !important;">Nama</th>
                                                <th colspan="<?= count($this->Kriteria_m->getGroupBy()) ?>">Kriteria</th>
                                                <!-- <th rowspan="2">Total</th> -->
                                            </tr>
                                            <tr>
                                                <?php foreach ($this->Kriteria_m->getGroupBy() as $kri): ?>
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
                                                $totalp[$pegawai->username] = 0;
                                                foreach ($this->Kriteria_m->getGroupBy() as $kri): ?>
                                                    <th><?php 
                                                        $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->username , 'id_kriteria' => $kri->id]);
                                                        if (!isset($nilai)) {
                                                            $totalp[$pegawai->username]+=0;
                                                            echo "0";
                                                        }
                                                        else{
                                                            $gabungan = $this->Kriteria_m->get(['gabungan' => $kri->gabungan]);
                                                            if (count($gabungan) == 1) {
                                                                $val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->bobot : 0;
                                                                $nilai_uti = $this->Nilai_kriteria_m->getUtiliti($val , $kri->id , $pegawai->username);
                                                            }
                                                            else{
                                                                $uti = 0;
                                                                foreach ($gabungan as $value) {
                                                                    $n = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->username , 'id_kriteria' => $value->id]);
                                                                    $v = ($this->Nilai_kriteria_m->get_row(['id' => $n->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $n->nilai])->bobot : 0;
                                                                    $uti += $this->Nilai_kriteria_m->getUtiliti($v , $value->id , $pegawai->username);
                                                                }
                                                                $nilai_uti = $uti/count($gabungan);
                                                            }
                                                            $totalp[$pegawai->username]+=$nilai_uti;
                                                            echo $nilai_uti;
                                                        }
                                                    ?></th>
                                                <?php endforeach ?>
                                                <!-- <td><?= $totalp[$pegawai->username] ?></td> -->
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
                                                <th rowspan="2" valign="center" style="vertical-align: center !important;">#</th>
                                                <th rowspan="2" valign="center" style="vertical-align: center !important;">Nama</th>
                                                <th colspan="<?= count($this->Kriteria_m->getGroupBy()) ?>">Kriteria</th>
                                                <th rowspan="2">Total</th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($this->Kriteria_m->getGroupBy() as $kri): ?>
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
                                                $totalh[$pegawai->username] = 0;
                                                foreach ($this->Kriteria_m->getGroupBy() as $kri): ?>
                                                    <th><?php 
                                                        $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->username , 'id_kriteria' => $kri->id]);
                                                        if (!isset($nilai)) {
                                                            $totalh[$pegawai->username]+=0;
                                                            echo "0";
                                                        }
                                                        else{
                                                            $gabungan = $this->Kriteria_m->get(['gabungan' => $kri->gabungan]);
                                                            if (count($gabungan) == 1) {
                                                                $val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->bobot : 0;
                                                                $nilai_uti = $this->Nilai_kriteria_m->getUtiliti($val , $kri->id , $pegawai->username);
                                                            }
                                                            else{
                                                                $uti = 0;
                                                                foreach ($gabungan as $value) {
                                                                    $n = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->username , 'id_kriteria' => $value->id]);
                                                                    $v = ($this->Nilai_kriteria_m->get_row(['id' => $n->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $n->nilai])->bobot : 0;
                                                                    $uti += $this->Nilai_kriteria_m->getUtiliti($v , $value->id , $pegawai->username);
                                                                }
                                                                $nilai_uti = $uti/count($gabungan);
                                                            }
                                                            $hasil = round ($nilai_uti * ($kri->bobot / $this->Kriteria_m->get_total()) , 3 ) ;
                                                            $totalh[$pegawai->username]+=$hasil;
                                                            echo $hasil;
                                                        }
                                                        // else{
                                                            
                                                        //     $val = ($this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])) ? $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai])->bobot : 0;
                                                        //     $nilai_uti = $this->Nilai_kriteria_m->getUtiliti($val , $kri->id);


                                                        //     $hasil = round ($nilai_uti * ($kri->bobot / $this->Kriteria_m->get_total()) , 3 ) ;
                                                        //     $totalh[$pegawai->username]+=$hasil;
                                                        //     echo $hasil;
                                                        // }
                                                    ?></th>
                                                <?php endforeach ?>
                                                <td><?= $totalh[$pegawai->username] * 100 ?></td>
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
                    $('.input-group.date').datepicker({format: "yyyy-mm-dd"});
                    
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                    $('#example').DataTable({
                        responsive: true
                    });
                });
            </script>