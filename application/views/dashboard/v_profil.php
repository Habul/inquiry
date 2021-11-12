<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Profile</h1>
					<small>Profile Pengguna</small>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Profile</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
				<div class="card card-success card-outline">
              	<div class="card-body box-profile">
                <div class="text-center">
				<?php $id_user = $this->session->userdata('id');
				$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row(); ?>
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url() . 'gambar/profile/' . $user->foto; ?>"
                       alt="User profile picture">
                </div>				
                <h3 class="profile-username text-center"><?php echo $user->pengguna_nama; ?></h3>
                <p class="text-muted text-center"><?php echo $user->pengguna_level; ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Username</b><a class="float-right"><?php echo $user->pengguna_username; ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
		</div>

        <div class="col-md-9">
		<?php
			if (isset($_GET['alert'])) {
				if ($_GET['alert'] == "sukses") {
					echo "<div class='alert alert-success alert-dismissible'>Profil telah diupdate!</div>";
				}
			}	
		?>
            <div class="card card-success card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="set_user" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="set_user" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="set_pass" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Password</a>
                  </li>
                </ul>
              </div>

			  <div class="card-body">
			  	<div class="tab-content" id="set_user">
						<?php foreach ($profil as $p) { ?>
							<form class="form-horizontal" method="post" action="<?php echo base_url('dashboard/profil_update') ?>" enctype="multipart/form-data">
                     				<div class="form-group row">
										<label for="inputName" class="col-sm-2 col-form-label">Nama *</label>
										<div class="col-sm-10">
										<input type="text" name="nama" id="inputName" class="form-control" placeholder="Masukkan nama .." value="<?php echo $p->pengguna_nama; ?>" required>
										<?php echo form_error('nama'); ?>
										</div>
                      				</div>
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Email *</label>
										<div class="col-sm-10">
										<input type="text" name="email" id="inputEmail" class="form-control" placeholder="Masukkan email .." value="<?php echo $p->pengguna_email; ?>" required>
										<?php echo form_error('email'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputfile" class="col-sm-2 col-form-label">Foto</label>
										<div class="col-sm-10">
										<input type="file" id="inputfile" name="foto"><br/>
										<small>* Max size 1 Mb</small><br />
										<small>* Max file name image 10 character</small><br />
										<small>* File type Jpg, Png & Gif</small>
										<?php echo form_error('foto'); ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="offset-sm-2 col-sm-10">
										<input type="submit" class="btn btn-info" value="Update">
										</div>
									</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>