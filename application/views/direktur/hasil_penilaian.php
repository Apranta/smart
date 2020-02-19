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
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                    <?php if ($this->session->userdata('role') != 2): ?>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#input"><i class="fa fa-plus"></i> Masukan Nilai</button>
                                    <?php endif ?>
                                    <hr>
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
                                    <?php if ($this->session->userdata('role') != 2): ?>
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
<div id="input" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <?= form_open('penilai/penilaian'); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Input Nilai</h4>
          </div>
          <div class="modal-body">
            <div class="form-group label-floating">
                <label class="control-label">Nama Calon Pegawai</label>
                <select name="id_pegawai" class="form-control">
                    <option value="">== Silahkan Pilih ==</option>
                    <?php foreach ($this->Pegawai_m->get() as $pegawai): ?>
                        <option value="<?= $pegawai->username ?>"><?= $pegawai->nama ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?php foreach ($this->Kriteria_m->get() as $kriteria): ?>
            <div class="form-group label-floating">
                <label class="control-label"><?= $kriteria->nama ?></label>
                <!-- <input type="number" name="<?= $kriteria->id ?>" value="0" class="form-control" max="100" min="0"> -->
                <select name="<?= $kriteria->id ?>" class="form-control">
                    <option value="">Silahkan Pilih</option>
                    <?php foreach ($this->Nilai_kriteria_m->get(['kriteria' => $kriteria->id]) as $value) : ?>
                        <option value="<?= $value->id ?>"> <?= $value->parameter ?></option>
                    <?php endforeach; ?>
                </select>
            </div>    
            <?php endforeach; ?>
            
          </div>
          <div class="modal-footer">
            <input name="simpan" value="Simpan" type="submit" class="btn btn-info">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
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
    function submit() {
        // body...
        $.ajax({
            url: "<?= base_url('penilai/penilaian') ?>",
            type: 'POST',
            data: {
                submit: true
            },
            success: function(respon) {
                if (respon === 'berhasil') {
                    alert('Data Berhasil Di submit');
                    window.location = "<?= base_url('penilai/nilai_pegawai') ?>";
                }
                else{
                    alert('Data gagal di submit');
                }
            }
        });
    }
            </script>