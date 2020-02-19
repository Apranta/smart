<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                            <h4>Penilaian Utiliti</h4>
                </div>
                <div class="panel-body">
                    <button class="btn btn-info" data-toggle="modal" data-target="#TambahData"><i class="fa fa-plus"></i> Tambah Data</button><hr>
                    <table class="table table-striped table-bordered table-hover" id="tabelku">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Nilai Kriteria
                                </th>
                                <th>
                                    Nilai Utiliti
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach ($data as $key): ?>
                            <tr>
                                <td>
                                   <?= ++$i ?> 
                                </td>
                                <td>
                                     <?= $key->nilai_kriteria ?>       
                                </td>
                                <td>
                                     <?= $key->nilai_utiliti ?>     
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#EditData" onclick="_edit(<?= $key->id ?>)"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-xs" onclick="_delete(<?= $key->id ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="TambahData" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <?= form_open('admin/nilai_utiliti'); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data</h4>
          </div>
          <div class="modal-body">
            <div class="form-group label-floating">
                <label class="form-label">Nilai Kriteria</label>
                <input type="number" name="nilai_kriteria" class="form-control">
            </div>
            <div class="form-group label-floating">
                <label class="control-label">Nilai Utiliti</label>
                <input type="number" name="nilai_utiliti" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info" name="insert" value="Tambah Data">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>

  </div>
</div>

<div id="EditData" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <?= form_open('admin/nilai_utiliti'); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Data</h4>
          </div>
          <div class="modal-body">
            <div class="form-group label-floating">
                <label class="form-label">Nilai Kriteria</label>
                <input type="hidden" name="edit_id" id="id">
                <input type="number" name="nilai_kriteria" class="form-control" id="nilai_kriteria">
            </div>
            <div class="form-group label-floating">
                <label class="control-label">Nilai Utiliti</label>
                <input type="number" name="nilai_utiliti" id="nilai_utiliti" class="form-control">
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
        $('#tabelku').DataTable();
    } );

                function _edit(id) {
                    $.ajax({
                            url: "<?= base_url('admin/nilai_utiliti') ?>",
                            type: 'POST',
                            data: {
                                id: id,
                                get: true
                            },
                            success: function(data) {
                                data = JSON.parse(data);
                                $('#nilai_utiliti').val(data.nilai_utiliti);
                                $('#id').val(data.id);
                                $('#nilai_kriteria').val(data.nilai_kriteria);
                            }
                    });
                }
                function _delete(id) {
                    $.ajax({
                            url: "<?= base_url('admin/nilai_utiliti') ?>",
                            type: 'POST',
                            data: {
                                id: id,
                                delete: true
                            },
                            success: function() {
                                window.location = "<?= base_url('admin/nilai_utiliti') ?>";
                            }
                        });
                }
</script>