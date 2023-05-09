<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Data Penting</h1>
					<small>Pindahan file TXT dan IMG di 217</small>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Data Penting</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success card-outline">
						<div class="card-header">
							<h6 class="card-title">
								<a class="btn btn-success col-15 shadow-sm" title="Add data" onclick="add_it()">
									<i class="fa fa-plus"></i>&nbsp; Add Data</a>
								<a class="btn btn-default shadow-sm" title="Reload" onclick="reload_table()">
									<i class="fas fa-sync-alt"></i>&nbsp; Reload
								</a>
							</h6>
							<div class="card-tools">
								<button type="button" class="btn btn-xs btn-icon" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon" data-card-widget="maximize">
									<i class="fas fa-expand"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<table id="table_it" class="table table-hover table-sm">
								<thead class="thead-dark text-center">
									<tr>
										<th width="3%">No</th>
										<th width="50%">Title</th>
										<th width="10%">Addtime</th>
										<th width="8%"><i class="fas fa-cogs"></i></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>

<div class="modal fade" id="modal_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Add Data
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<form method="post" id="form_add" enctype="multipart/form-data">
				<div class="modal-body">
				<input type="hidden" value="" name="id"/> 
					<div class="form-group">
						<label class="control-label col-xs-3">Title *</label>
						<div class="col-xs-9">
							<input type="text" name="judul" class="form-control form-control-sm form-control-border" placeholder="Input Judul..">
							<span class="help-block text-danger"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Description *</label>
						<div class="col-xs-9">
							<textarea class="form-control form-control-sm" name="isi" rows="10" placeholder="Input Isi.."></textarea>
							<span class="help-block text-danger"></span>
						</div>
					</div>
					<div class="form-group" id="photo-preview">
                  	<div class="col-xs-9">
                        <span class="help-block text-danger"></span>
                     </div>
               </div>
					<div class="form-group mb-0">
						<label class="control-label col-xs-3" id="label-photo">Attach</label>
						<div class="col-xs-9">
							<input name="file" type="file">
                     <span class="help-block text-danger"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

	<div class="modal fade" id="modal_view" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form method="post" id="form_view">
					<div class="modal-body">
						<input type="hidden" name="id" readonly class="form-control">
						<div class="form-group">
							<div class="col-xs-9">
								<textarea class="form-control form-control-sm form-control-border" readonly rows="13" name="isi"></textarea>
							</div>
						</div>
						<div class="form-group mb-0" id="photo-preview">
                     <div class="col-md-9">
                        <span class="help-block"></span>
                     </div>
                  </div>
					</div>
					<div class="modal-footer justify-content-center">
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>