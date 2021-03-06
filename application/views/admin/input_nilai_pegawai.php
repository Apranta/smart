<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                            <h4>Penilaian Pegawai</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="tabelku">
                        <thead>
                            <tr>
                                <th>
                                    id
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Nama Calon Pegawai
                                </th>
                                <th>
                                    Nilai
                                </th>
                                <th>
                                    Bobot
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                            
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#TambahData"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#EditData"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
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
        <?= form_open('admin/input_nilai_utiliti'); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data</h4>
          </div>
          <div class="modal-body">
            <div class="form-group label-floating">
                <label class="form-label">Nama Calon Pegawai</label>
                    <select name="nilai_utiliti" class="form-control">
                        <option value="">-- Pilih Keterangan ---</option>
                        <option value="id">Nama</option>
                    </select>
            </div>
            <div class="form-group label-floating">
                <label class="control-label">Nilai Utiliti</label>
                <input type="number" name="bobot" class="form-control">
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
        <?= form_open('admin/input_nilai_utiliti'); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Data</h4>
          </div>
          <div class="modal-body">
            <div class="form-group label-floating">
                <label class="control-label">Nilai Utiliti</label>
                <input type="number" name="nilai_utiliti" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Edit Data</button>
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
</script>