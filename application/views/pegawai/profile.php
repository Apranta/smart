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
								
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Data Diri</h4>
										<ul class="list-unstyled list-justify">
											<li>Email<span><?= $user->email ?></span></li>
											<li>Telepon<span><?= $user->telepon ?></span></li>
											<li>Tempat Lahir <span><?= $user->tempat_lahir ?></span></li>
											<li>Tanggal Lahir <span><?= $user->tanggal_lahir ?></span></li>
											<li>Alamat<span><?= $user->alamat ?></span></li>
											<li>Tahun Penerimaan<span><?= $user->tahun_penerimaan ?></span></li>
										</ul>
									<hr>
									<a href="<?= base_url('pegawai/edit_profile') ?>" class="btn btn-primary">Edit Profile</a>
											</div>		
										</div>
									</div>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>