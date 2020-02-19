<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Data Parameter Kriteria <b><?= $this->Kriteria_m->get_row(['id' => $id])->nama ?></b>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <style type="text/css">
                                        tr th, tr td {text-align: center; padding: 1%;}
                                    </style>
                                    <?= form_open('admin/parameter/'.$id); ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Parameter</th>
                                                <th>Nilai</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="parameter" class="form-control"></td>
                                                <td><input type="number" name="nilai" class="form-control"></td>
                                                <td><input type="submit" name="simpan" value="Simpan" class="btn btn-success"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?= form_close() ?>
                                    <hr>
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Parameter</th>
                                                <th>Nilai</th>
                                                <th>Action</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($data as $row): ?>
                                            <tr>
                                                <td style="width: 20px !important;" ><?= $i ?></td>
                                                <td><?= $row->parameter ?></td>
                                                <td><?= $row->nilai ?></td>
                                                <td align="center">
                                                <button class="btn btn-danger btn-xs" onclick="_delete(<?= $row->id ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                                <button class="btn btn-primary btn-xs" onclick="_edit(<?= $row->id ?>)" data-toggle="modal" data-target="#EditData"><i class="fa fa-edit"></i></button>
                                                </td>
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

<div id="EditData" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <?= form_open('admin/parameter/'.$id); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Data</h4>
          </div>
          <div class="modal-body">
            <div class="form-group label-floating">
                <label class="control-label">Parameter</label>
                <input type="hidden" name="edit_id" id="id">
                <input type="text" class="form-control" name="parameter" id="parameter">
            </div>
            <div class="form-group label-floating">
                <label class="control-label">Batas</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="number" name="nilai_awal" class="form-control" id="nilai_awal">
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="nilai_akhir" class="form-control" id="nilai_akhir">
                    </div>
                </div>
            </div>
            <div class="form-group label-floating">
                <label class="control-label">Bobot</label>
                <input type="number" name="bobot" class="form-control" id="bobot">
            </div>
          </div>
          <div class="modal-footer">
            <input name="edit" value="Edit" type="submit" class="btn btn-info">
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
                function _edit(id) {
                    $.ajax({
                            url: "<?= base_url('admin/parameter/'.$id) ?>",
                            type: 'POST',
                            data: {
                                id: id,
                                get: true
                            },
                            success: function(data) {
                                data = JSON.parse(data);
                                $('#parameter').val(data.parameter);
                                $('#id').val(data.id);
                                $('#bobot').val(data.bobot);
                                $('#nilai_awal').val(data.nilai_awal);
                                $('#nilai_akhir').val(data.nilai_akhir);
                            }
                    });
                }
                function _delete(id) {
                    $.ajax({
                            url: "<?= base_url('admin/parameter/'.$id) ?>",
                            type: 'POST',
                            data: {
                                id: id,
                                delete: true
                            },
                            success: function() {
                                window.location = "<?= base_url('admin/parameter') ?>";
                            }
                        });
                }
            </script>