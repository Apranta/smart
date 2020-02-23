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
                                tr th,
                                tr td {
                                    text-align: center;
                                    padding: 1%;
                                }
                            </style>
                            <h3 class="text-center">Tambah Nilai Tes Tertulis</h3>
                            <hr>
                            <?= $this->session->flashdata('msg') ?>
                            <?= form_open('penilai/tes-tertulis'); ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="id" class="form-control" id="select" style="width: 100%;">
                                                <option value="">== Pilih Pendaftar ==</option>
                                                <?php foreach ($this->Pegawai_m->get() as $key) : ?>
                                                    <option value="<?= $key->id_pegawai ?>"><?= $key->nama ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </td>
                                        <td><input type="number" name="nilai" value="0" class="form-control" max="100"></td>
                                        <td>
                                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                            <hr>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                            <th>Nilai</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($data as $row) :
                                        $total = 0;
                                    ?>
                                        <tr>
                                            <td style="width: 20px !important;"><?= $i ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= ($this->Tes_tertulis_m->get_row(['id_pegawai' => $row->id_pegawai])) ? $this->Tes_tertulis_m->get_row(['id_pegawai' => $row->id_pegawai])->nilai : '0' ?></td>
                                            <td align="center">
                                                    <?php if ($row->tes == 1): ?>
                                                        <button class="btn btn-danger" onclick="batal('<?= $row->id_pegawai ?>')">TIDAK DITERIMA</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-success" onclick="lulus('<?= $row->id_pegawai ?>')"> DITERIMA</button>
                                                    <?php endif ?>
                                                </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
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

<div id="Edit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <?= form_open('penilai/tes-tertulis'); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <div class="form-group label-floating">
                    <label class="control-label">Nama</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" name="nama" id="nama" class="form-control" readonly>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">TIU</label>
                    <input type="number" name="tiu" id="tiu" class="form-control">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">TKD</label>
                    <input type="number" name="tkd" id="tkd" class="form-control">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">TWK</label>
                    <input type="number" name="twk" id="twk" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-info" name="edit" value="Edit Data">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
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
    });

    $("#select").select2();

    function _edit(id, nama) {
        $.ajax({
            url: '<?= base_url('penilai/tes-tertulis/') ?>',
            type: 'POST',
            data: {
                get: true,
                id: id
            },
            success: function(data) {
                // alert(data);
                data = JSON.parse(data);
                $('#id').val(data.id);
                $('#nama').val(nama);
                $('#tiu').val(data.tiu);
                $('#tkd').val(data.tkd);
                $('#twk').val(data.twk);
            }
        });
    }

    function _submit() {
        $.ajax({
            url: '<?= base_url('penilai/tes-tertulis/') ?>',
            type: 'POST',
            data: {
                submit: true,
            },
            success: function(data) {
                // alert(data);
                if (data === 'berhasil') {
                    alert('Data Berhasil di submit Silahkan cek data kelulusan');
                } else {
                    alert('ada kesalahan pada jaringan silahkan ulangi');
                }

                window.location = '<?= base_url('penilai/tes-tertulis') ?>';
            }
        });
    }

    function lulus(username) {
                    // alert('aa');
                    $.ajax({
                            url: "<?= base_url('penilai/tes-tertulis') ?>",
                            type: 'POST',
                            data: {
                                username: username,
                                konfirm: true
                            },
                            success: function() {
                                window.location = "<?= base_url('penilai/tes-tertulis') ?>";
                            }
                        });
                }

                function batal(username) {
                    // alert('aa');
                    $.ajax({
                            url: "<?= base_url('penilai/tes-tertulis') ?>",
                            type: 'POST',
                            data: {
                                username: username,
                                notkonfirm: true
                            },
                            success: function() {
                                window.location = "<?= base_url('penilai/tes-tertulis') ?>";
                            }
                        });
                }
</script>