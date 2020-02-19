<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Hasil Penilaian Calon Pegawai</h4>
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
                        </div>
                        <div class="panel-footer">
                            <?php if ($this->session->userdata('role') != 2) : ?>
                                <button class="btn btn-primary" onclick="submit()">Submit Penilaian</button>
                            <?php endif ?>
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
        $('.input-group.date').datepicker({
            format: "yyyy-mm-dd"
        });

        $('#dataTables-example').DataTable({
            responsive: true
        });

        $('#select').select2();
        $('.chosen-select').chosen({
            width: "100%"
        });
    });

    function submit() {
        // body...
        $.ajax({
            url: "<?= base_url('penilai/penilaian') ?>",
            type: 'POST',
            data: {
                submit: true
            },
            success: function(respon) {
                console.log(respon)
                if (respon === 'berhasil') {
                    alert('Data Berhasil Di submit');
                    window.location = "<?= base_url('penilai/nilai_pegawai') ?>";
                } else {
                    alert('Data gagal di submit');
                }
            }
        });
    }
</script>