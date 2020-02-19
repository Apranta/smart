<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="<?= base_url('assets/img/user').'/'.$user->username.'.jpg' ?>" class="img img-circle" alt="Avatar" onerror="this.src = '<?= base_url('assets/img/user/default_user.png') ?>'" width="50%">
										<h3 class="name"><?= $user->nama ?></h3>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<!--  -->
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<h4 class="heading">Edit Profile</h4>
								<?= form_open('admin/edit_profile/' .  $user->username) ?>
								<input type="hidden" name="username" value="<?= $user->username ?>">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" value="<?= $user->nama ?>">
								</div>
								<div class="form-group">
									<label>Telepon</label>
									<input type="text" name="telepon" class="form-control" value="<?= $user->telepon ?>">
								</div>
								<div class="form-group">
									<label>Tempat Lahir</label>
									<input type="text" name="tempat_lahir" class="form-control" value="<?= $user->tempat_lahir ?>">
								</div>
								<div class="form-group">
	                                <label>Tanggal Lahir</label>
	                                <div class="input-group date">
	                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                                      <input type="text" name="tanggal_lahir" id="waktu" class="form-control" placeholder="YYYY-MM-DD" value="<?= $user->tanggal_lahir ?>" required>
	                                </div>
	                            </div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea name="alamat" class="form-control"><?= $user->alamat ?></textarea>
								</div>
								<div class="form-group">
									<label>Pendidikan Terakhir</label>
									<select name="pendidikan" class="form-control">
										<option value="SMA">SMA</option>
										<option value="SMP">SMP</option>
										<option value="SARJANA">Sarjana</option>
										<option value="MAGISTER">Magister</option>
									</select>
								</div>
								<hr>
								<div class="form-group">
									<input type="submit" name="simpan" value="Simpan" class="btn btn-info">
								</div>
								<?= form_close() ?>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>

			<script>
                $(document).ready(function() {
                    $('.input-group.date').datepicker({format: "yyyy-mm-dd"});
                    
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });
            </script>