<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

                                <?php if ($this->session->userdata('role') == 1): ?>
                                    
            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            Tambah Data Berkas
                        </div>
                        <div class="panel-body">
                            <?= form_open('admin/data-berkas') ?>
                            <div class="form-group">
                                <label>Nama Berkas</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            Data Berkas
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach ($berkas as $value): ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $value->nama ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/data-berkas/delete/' . $value->id_berkas) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 
            </div>
        <?php endif; ?>
            <div class="row">
            	<div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Berkas Administrasi
                        </div>
            		<table class="table table-bordered table-responsive">
            			<thead>
            				<tr>
            					<th>#</th>
            					<th>Nama Calon Pegawai</th>
            					<th>Data Berkas</th>
            				</tr>
            			</thead>
            			<tbody>
                            <?php $i=0; foreach ($data as $Pegawai): 
                                $berkas = $this->Data_berkas_m->get(['id_pegawai' => $Pegawai->username]);
                            ?>
            				<tr>
            					<td><?= ++$i  ?></td>
            					<td><?= $Pegawai->nama ?></td>
            					<td>
            						<?php if (!$berkas): ?>
                                        Berkas belum ada
                                    <?php else : ?>
                                    <ul>
                                        <?php foreach ($berkas as $key): ?>
                                            <li><button onclick="view(<?= $key->id ?>)" data-toggle="modal" data-target="#view" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> <?= $this->Berkas_m->get_row(['id_berkas' => $key->id_data_berkas])->nama ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php endif ?>
            					</td>
            				</tr>	
                            <?php endforeach ?>
            			</tbody>
            		</table>
                    </div>
            	</div>
            </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="view">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body" align="center">
              	<iframe id="myImg" height="500px" width="500px"></iframe>
                <!-- <img  class="img img-responsive" id="myImg">             -->
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function view(id_pemesanan) {
        document.getElementById("myImg").src = "<?= base_url('assets/berkas').'/'?>" + id_pemesanan + '.pdf';
    }

    function lulus(username) {
    	// alert('aa');
    	$.ajax({
                url: "<?= base_url('manager/data-berkas') ?>",
                type: 'POST',
                data: {
                    username: username,
                    konfirm: true
                },
                success: function() {
                    window.location = "<?= base_url('manager/data-berkas') ?>";
                }
            });
    }

    function batal(username) {
        // alert('aa');
        $.ajax({
                url: "<?= base_url('manager/data-berkas') ?>",
                type: 'POST',
                data: {
                    username: username,
                    notkonfirm: true
                },
                success: function() {
                    window.location = "<?= base_url('manager/data-berkas') ?>";
                }
            });
    }
</script>