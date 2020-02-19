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
								<img src="<?= base_url('assets/img/user') . '/' . $user->id_pegawai . '.jpg' ?>" class="img img-circle" alt="Avatar" onerror="this.src = '<?= base_url('assets/img/user/default_user.png') ?>'" width="50%">
								<h3 class="name"><?= $user->nama ?></h3>
							</div>
						</div>
						<!-- END PROFILE HEADER -->
						<!-- PROFILE DETAIL -->
						<div class="profile-detail">
							<div class="profile-info">
								<?= form_open_multipart('pegawai/edit_profile') ?>
								<div class="form-group">
									<label for=""> Pilih Foto</label>
									<input type="file" name="foto" class="form-control">
								</div>
								<input type="submit" name="simpan-foto" value="Upload Foto" class="btn btn-info">
								<?= form_close() ?>
							</div>
							<!-- <div class="text-center"><a href="<?= base_url('pegawai/profile') ?>" class="btn btn-primary">Edit Profile</a></div> -->
						</div>
						<!-- END PROFILE DETAIL -->
					</div>
					<!-- END LEFT COLUMN -->
					<!-- RIGHT COLUMN -->
					<div class="profile-right">
						<h4 class="heading">Edit Profile</h4>
						<?= form_open('pegawai/edit_profile') ?>
						<div class="form-group">
							<label>Nomor KTP</label>
							<input type="text" name="no_ktp" class="form-control" value="<?= $user->no_ktp ?>">
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" class="form-control" value="<?= $user->nama ?>">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" class="form-control" value="<?= $user->email ?>">
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
							<label>Genre Musik <small>*jika lebih dari 1 pisahkan dengan koma</small></label>
							<textarea name="genre" class="form-control"><?= $user->genre_musik ?></textarea>
						</div>
						<div class="form-group">
							<label>Bahasa yang di kuasasi <small>*jika lebih dari 1 pisahkan dengan koma</small></label>
							<textarea name="bahasa" class="form-control"><?= $user->bahasa ?></textarea>
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
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h4>Pendidikan Terakhir &nbsp; <span><button onclick="add_pendidikan()" class="btn btn-xs btn-primary">+</button></span></h4>
					<?= form_open('pegawai/edit_profile') ?>
					<table class="table table-responsive">
						<thead>
							<tr>
								<th>Strata Pendidikan</th>
								<th>Tahun Lulus</th>
								<th>Nama Lembaga</th>
							</tr>
						</thead>
						<tbody id="pendidikan">
							<?php
							$pendidikan = json_decode($user->pendidikan);

							if (empty($pendidikan[0])) :
							?>
								<tr>
									<td>
										<input type="text" name="pendidikan[]" class="form-control">
									</td>
									<td>
										<input type="text" name="lulus[]" class="form-control">
									</td>
									<td>
										<input type="text" name="nama[]" class="form-control">
									</td>
								</tr>
								<?php else :
								foreach ($pendidikan as $pend) :
								?>
									<tr>
										<td>
											<input type="text" name="pendidikan[]" class="form-control" value="<?= $pend->pendidikan ?>">
										</td>
										<td>
											<input type="text" name="lulus[]" class="form-control" value="<?= $pend->lulus ?>">
										</td>
										<td>
											<input type="text" name="nama[]" class="form-control" value="<?= $pend->nama ?>">
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
						</tbody>
					</table>
					<hr>
					<div class="form-group">
						<input type="submit" name="add_pendidikan" value="Simpan" class="btn btn-info">
					</div>

					<?= form_close() ?>
				</div>
			</div>
		</div>

		<!-- Pengalaman Kerja -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h4>Pengalaman Kerja &nbsp; <span><button onclick="add_pengalaman()" class="btn btn-xs btn-primary">+</button></span></h4>
					<?= form_open('pegawai/edit_profile') ?>
					<table class="table table-responsive">
						<thead>
							<tr>
								<th>Nama Institusi</th>
								<th>Posisi</th>
								<th>Lama Bekerja</th>
							</tr>
						</thead>
						<tbody id="pengalaman">
							<?php
							$pengalaman = json_decode($user->pengalaman_kerja);

							if (empty($pengalaman[0])) :
							?>
								<tr>
									<td>
										<input type="text" name="nama[]" class="form-control">
									</td>
									<td>
										<input type="text" name="posisi[]" class="form-control">
									</td>
									<td>
										<input type="text" name="masa_kerja[]" class="form-control">
									</td>
								</tr>
								<?php else :
								foreach ($pengalaman as $pend) :
								?>
									<tr>
										<td>
											<input type="text" name="nama[]" class="form-control" value="<?= $pend->nama ?>">
										</td>
										<td>
											<input type="text" name="posisi[]" class="form-control" value="<?= $pend->posisi ?>">
										</td>
										<td>
											<input type="text" name="masa_kerja[]" class="form-control" value="<?= $pend->masa_kerja ?>">
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
						</tbody>
					</table>
					<hr>
					<div class="form-group">
						<input type="submit" name="add_pengalaman" value="Simpan" class="btn btn-info">
					</div>

					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
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

	function add_pendidikan() {
		$("#pendidikan").append('<tr><td><input type="text" name="pendidikan[]" class="form-control"></td>' +
			'<td><input type="text" name="lulus[]" class="form-control"></td><td>' +
			'<input type="text" name="nama[]" class="form-control"></td></tr>');
	}

	function add_pengalaman() {
		$("#pengalaman").append('<tr><td><input type="text" name="nama[]" class="form-control"></td>' +
			'<td><input type="text" name="posisi[]" class="form-control"></td><td>' +
			'<input type="text" name="masa_kerja[]" class="form-control"></td></tr>');
	}
</script>