<!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
				  			<h4>Kriteria</h4>
				</div>
				<div class="panel-body">
					<button class="btn btn-info" data-toggle="modal" data-target="#TambahData"><i class="fa fa-plus"></i> Tambah Data</button><hr>
					<table class="table table-striped table-bordered table-hover" id="tabelku">
						<thead>
							<tr>
								<?php foreach ($columns as $column): ?>
									<th>
										<?= ($column == 'id')? '#' : ucwords(str_replace("_", " ", $column)) ?>
									</th>
								<?php endforeach; ?>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($data as $row): ?>
							<tr>
								<?php foreach ($columns as $column): ?>
									<td>
										<?php $row = (array)$row; ?>
										<?= ($column == 'id') ? ++$i : $row[$column] ?>
									</td>
								<?php endforeach; ?>
								<td align="center">
									<a href="<?= base_url('admin/parameter/'.$row['id']) ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Lihat Parameter"><i class="fa fa-eye"></i></a>
									<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#EditData" onclick="_edit(<?= $row['id'] ?>)"><i class="fa fa-edit"></i></button>
									<button type="button" class="btn btn-danger btn-xs" onclick="_delete(<?= $row['id'] ?>)"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
							<?php endforeach; ?>
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
		<?= form_open('admin/kriteria'); ?>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Tambah Data</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group label-floating">
				<label class="control-label">Nama</label>
				<input type="text" name="nama" class="form-control">
			</div>
	        <div class="form-group label-floating">
				<label class="control-label">Bobot</label>
				<input type="text" name="bobot" class="form-control">
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
		<?= form_open('admin/kriteria'); ?>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Data</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group label-floating">
				<label class="control-label">Nama</label>
				<input type="hidden" name="edit_id" id="id">
				<input type="text" class="form-control" name="nama" id="nama">
			</div>
	        <div class="form-group label-floating">
				<label class="control-label">bobot</label>
				<input type="text" name="bobot" id="bobot" class="form-control">
			</div>
	      </div>
	      <div class="modal-footer">
	      	<input type="submit" name="edit" value="Edit" class="btn btn-info">
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
		// body...
		$.ajax({
            url: "<?= base_url('admin/kriteria') ?>",
            type: 'POST',
            data: {
                id: id,
                get: true
            },
            success: function(data) {
            	data = JSON.parse(data);
            	$('#nama').val(data.nama);
            	$('#bobot').val(data.bobot);
            	$('#id').val(data.id);
            }
        });
	}

	function _delete(id) {
		// body...
		$.ajax({
            url: "<?= base_url('admin/kriteria') ?>",
            type: 'POST',
            data: {
                id: id,
                delete: true
            },
            success: function() {
            	window.location = "<?= base_url('admin/kriteria') ?>";
            }
        });
	}
</script>