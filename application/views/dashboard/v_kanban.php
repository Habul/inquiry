<div class="content-wrapper kanban">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Workspace Board</h1>
					<small>Project ERP 7 Soft</small>
				</div>
				<div class="col-sm-6 d-none d-sm-block">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Workspace Board</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content pb-3">
		<div class="container-fluid h-100">
			<div class="card card-row card-primary">
				<div class="card-header">
					<h3 class="card-title">
						To Do
					</h3>
				</div>
				<div class="card-body">
					<?php foreach ($todo as $row) : ?>
						<div class="card card-primary card-outline collapsed-card">
							<div class="card-header" data-card-widget="collapse">
								<h6 class="card-title"><?= $row->header ?></h6>
								<div class="card-tools">
									<div class="btn-group">
										<a class="text-muted dropdown-toggle" data-toggle="dropdown"><i class="fas fa-marker"></i></a>
										<div class="dropdown-menu">
											<a class="dropdown-item" data-toggle="modal" data-target="#todo_edit<?= $row->id; ?>">Edit</a>
											<a class="dropdown-item" data-toggle="modal" data-target="#todo_delete<?= $row->id; ?>">Delete</a>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<pre class="p-0 m-0"><?= $row->body ?></pre>
							</div>
						</div>
					<?php endforeach; ?>
					<button class="btn btn-block btn-light btn-sm" data-toggle="modal" data-target="#todo_add">
						<i class="fa fa-plus"></i>&nbsp;Add a card
					</button>
				</div>
			</div>

			<div class="card card-row card-default">
				<div class="card-header bg-info">
					<h3 class="card-title">
						In Progress
					</h3>
				</div>
				<div class="card-body">
					<?php foreach ($progress as $row) : ?>
						<div class="card card-info card-outline collapsed-card">
							<div class="card-header" data-card-widget="collapse">
								<h6 class="card-title"><?= $row->header ?></h6>
								<div class="card-tools">
									<div class="btn-group">
										<a class="text-muted dropdown-toggle" data-toggle="dropdown"><i class="fas fa-marker"></i></a>
										<div class="dropdown-menu">
											<a class="dropdown-item" data-toggle="modal" data-target="#progress_edit<?= $row->id; ?>">Edit</a>
											<a class="dropdown-item" data-toggle="modal" data-target="#progress_del<?= $row->id; ?>">Delete</a>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<pre class="p-0 m-0"><?= $row->body ?></pre>
							</div>
						</div>
					<?php endforeach; ?>
					<button class="btn btn-block btn-light btn-sm" data-toggle="modal" data-target="#progress_add">
						<i class="fa fa-plus"></i>&nbsp;Add a card
					</button>
				</div>
			</div>

			<div class="card card-row card-success">
				<div class="card-header">
					<h3 class="card-title">
						Done
					</h3>
				</div>
				<div class="card-body">
					<?php foreach ($done as $row) : ?>
						<div class="card card-success card-outline collapsed-card">
							<div class="card-header" data-card-widget="collapse">
								<h6 class="card-title"><?= $row->header ?></h6>
								<div class="card-tools">
									<div class="btn-group">
										<a class="text-muted dropdown-toggle" data-toggle="dropdown"><i class="fas fa-marker"></i></a>
										<div class="dropdown-menu">
											<a class="dropdown-item" data-toggle="modal" data-target="#done_edit<?= $row->id; ?>">Edit</a>
											<a class="dropdown-item" data-toggle="modal" data-target="#done_del<?= $row->id; ?>">Delete</a>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<pre class="p-0 m-0"><?= $row->body ?></pre>
							</div>
						</div>
					<?php endforeach; ?>
					<button class="btn btn-block btn-light btn-sm" data-toggle="modal" data-target="#done_add">
						<i class=" fa fa-plus"></i>&nbsp;Add a card
					</button>
				</div>
			</div>

			<div class="card card-row card-danger">
				<div class="card-header">
					<h3 class="card-title">
						Failed
					</h3>
				</div>
				<div class="card-body">
					<?php foreach ($failed as $row) : ?>
						<div class="card card-success card-outline collapsed-card">
							<div class="card-header" data-card-widget="collapse">
								<h6 class="card-title"><?= $row->header ?></h6>
								<div class="card-tools">
									<div class="btn-group">
										<a class="text-muted dropdown-toggle" data-toggle="dropdown"><i class="fas fa-marker"></i></a>
										<div class="dropdown-menu">
											<a class="dropdown-item" data-toggle="modal" data-target="#failed_edit<?= $row->id; ?>">Edit</a>
											<a class="dropdown-item" data-toggle="modal" data-target="#failed_del<?= $row->id; ?>">Delete</a>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<pre class="p-0 m-0"><?= $row->body ?></pre>
							</div>
						</div>
					<?php endforeach; ?>
					<button class="btn btn-block btn-light btn-sm" data-toggle="modal" data-target="#failed_add">
						<i class="fa fa-plus"></i>&nbsp;Add a card
					</button>
				</div>
			</div>
	</section>
</div>

<!-- todo modal add -->
<div class="modal fade" id="todo_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Add to do
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_add') ?>">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-xs-9">
							<input type="hidden" name="status" value="1">
							<input type="hidden" name="ket" value="to do">
							<input type="text" name="header" class="form-control form-control-sm form-control-border" placeholder="Header.." required>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="col-xs-9">
							<textarea class="form-control form-control-sm" name="body" rows="7" placeholder="Body.." required></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="form-control btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Add-->

<!-- todo modal Edit & delete -->
<?php foreach ($todo as $row) : ?>
	<div class="modal fade" id="todo_edit<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Edit to do
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<div class="col-xs-9">
								<input type="hidden" name="id" value="<?= $row->id ?>">
								<input type="hidden" name="ket" value="to do">
								<input type="text" name="header" class="form-control form-control-sm form-control-border" value="<?= $row->header ?>" required>
							</div>
						</div>
						<div class="form-group">
							<div class=" col-xs-9">
								<textarea class="form-control form-control-sm" name="body" rows="10" required><?= $row->body ?></textarea>
							</div>
						</div>
						<div class="form-group mb-0">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text form-control-sm">Card group</label>
								</div>
								<select class="form-control form-control-sm" name="status" required>
									<option <?php if ($row->status == "1") {
													echo "selected='selected'";
												} ?> value="1">To Do</option>
									<option <?php if ($row->status == "2") {
													echo "selected='selected'";
												} ?> value="2">In Progress</option>
									<option <?php if ($row->status == "3") {
													echo "selected='selected'";
												} ?> value="3">Done</option>
									<option <?php if ($row->status == "4") {
													echo "selected='selected'";
												} ?> value="4">Failed</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="form-control btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="todo_delete<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Delete to do
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?= $row->id; ?>">
						<input type="hidden" name="ket" value="to do">
						<span>Are you sure delete <?= $row->header ?> ?</span>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--End Modals Add-->

<!-- progress modal add -->
<div class="modal fade" id="progress_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Add progress
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_add') ?>">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-xs-9">
							<input type="hidden" name="status" value="2">
							<input type="hidden" name="ket" value="In Progress">
							<input type="text" name="header" class="form-control form-control-sm form-control-border" placeholder="Header.." required>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="col-xs-9">
							<textarea class="form-control form-control-sm" name="body" rows="7" placeholder="Body.." required></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="form-control btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Add-->

<!-- progress modal Edit & delete -->
<?php foreach ($progress as $row) : ?>
	<div class="modal fade" id="progress_edit<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Edit progress
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<div class="col-xs-9">
								<input type="hidden" name="id" value="<?= $row->id ?>">
								<input type="hidden" name="ket" value="In Progress">
								<input type="text" name="header" class="form-control form-control-sm form-control-border" value="<?= $row->header ?>" required>
							</div>
						</div>
						<div class="form-group">
							<div class=" col-xs-9">
								<textarea class="form-control form-control-sm" name="body" rows="10" required><?= $row->body ?></textarea>
							</div>
						</div>
						<div class="form-group mb-0">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text form-control-sm">Card group</label>
								</div>
								<select class="form-control form-control-sm" name="status" required>
									<option <?php if ($row->status == "1") {
													echo "selected='selected'";
												} ?> value="1">To Do</option>
									<option <?php if ($row->status == "2") {
													echo "selected='selected'";
												} ?> value="2">In Progress</option>
									<option <?php if ($row->status == "3") {
													echo "selected='selected'";
												} ?> value="3">Done</option>
									<option <?php if ($row->status == "4") {
													echo "selected='selected'";
												} ?> value="4">Failed</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="form-control btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="progress_del<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Delete in progress
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?= $row->id; ?>">
						<input type="hidden" name="ket" value="In Progress">
						<span>Are you sure delete <?= $row->header ?> ?</span>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--End Modals Add-->


<!-- done modal add -->
<div class="modal fade" id="done_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Add done
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_add') ?>">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-xs-9">
							<input type="hidden" name="status" value="3">
							<input type="hidden" name="ket" value="Done">
							<input type="text" name="header" class="form-control form-control-sm form-control-border" placeholder="Header.." required>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="col-xs-9">
							<textarea class="form-control form-control-sm" name="body" rows="7" placeholder="Body.." required></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="form-control btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Add-->

<!-- done modal Edit & delete -->
<?php foreach ($done as $row) : ?>
	<div class="modal fade" id="done_edit<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Edit done
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<div class="col-xs-9">
								<input type="hidden" name="id" value="<?= $row->id ?>">
								<input type="hidden" name="ket" value="Done">
								<input type="text" name="header" class="form-control form-control-sm form-control-border" value="<?= $row->header ?>" required>
							</div>
						</div>
						<div class="form-group">
							<div class=" col-xs-9">
								<textarea class="form-control form-control-sm" name="body" rows="10" required><?= $row->body ?></textarea>
							</div>
						</div>
						<div class="form-group mb-0">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text form-control-sm">Card group</label>
								</div>
								<select class=" form-control form-control-sm" name=" status" required>
									<option <?php if ($row->status == "1") {
													echo "selected='selected'";
												} ?> value="1">To Do</option>
									<option <?php if ($row->status == "2") {
													echo "selected='selected'";
												} ?> value="2">In Progress</option>
									<option <?php if ($row->status == "3") {
													echo "selected='selected'";
												} ?> value="3">Done</option>
									<option <?php if ($row->status == "4") {
													echo "selected='selected'";
												} ?> value="4">Failed</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="form-control btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="done_del<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Delete done
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?= $row->id; ?>">
						<input type="hidden" name="ket" value="Done">
						<span>Are you sure delete <?= $row->header ?> ?</span>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!--End Modals Add-->


<!-- failed modal add -->
<div class="modal fade" id="failed_add" tabindex="-1" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-12 modal-title text-center">Add failed
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
			</div>
			<form onsubmit="addbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_add') ?>">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-xs-9">
							<input type="hidden" name="status" value="4">
							<input type="hidden" name="ket" value="Failed">
							<input type="text" name="header" class="form-control form-control-sm form-control-border" placeholder="Header.." required>
						</div>
					</div>
					<div class="form-group mb-0">
						<div class="col-xs-9">
							<textarea class="form-control form-control-sm" name="body" rows="7" placeholder="Body.." required></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="form-control btn btn-primary" id="addbtn"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--End Modals Add-->

<!-- failed modal Edit & delete -->
<?php foreach ($failed as $row) : ?>
	<div class="modal fade" id="failed_edit<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Edit failed
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="editbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_edit') ?>">
					<div class="modal-body">
						<div class="form-group">
							<div class="col-xs-9">
								<input type="hidden" name="id" value="<?= $row->id ?>">
								<input type="hidden" name="ket" value="Failed">
								<input type="text" name="header" class="form-control form-control-sm form-control-border" value="<?= $row->header ?>" required>
							</div>
						</div>
						<div class="form-group">
							<div class=" col-xs-9">
								<textarea class="form-control form-control-sm" name="body" rows="10" required><?= $row->body ?></textarea>
							</div>
						</div>
						<div class="form-group mb-0">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text form-control-sm">Card group</label>
								</div>
								<select class="form-control form-control-sm" name=" status" required>
									<option <?php if ($row->status == "1") {
													echo "selected='selected'";
												} ?> value="1">To Do</option>
									<option <?php if ($row->status == "2") {
													echo "selected='selected'";
												} ?> value="2">In Progress</option>
									<option <?php if ($row->status == "3") {
													echo "selected='selected'";
												} ?> value="3">Done</option>
									<option <?php if ($row->status == "4") {
													echo "selected='selected'";
												} ?> value="4">Failed</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="form-control btn btn-primary" id="editbtn"><i class="fa fa-check"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="failed_del<?= $row->id; ?>" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Delete failed
						<button class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<form onsubmit="delbtn.disabled = true; return true;" method="post" action="<?php echo base_url('dashboard/workspace_del') ?>">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?= $row->id; ?>">
						<input type="hidden" name="ket" value="Failed">
						<span>Are you sure delete <?= $row->header ?> ?</span>
					</div>
					<div class="modal-footer justify-content-between">
						<button class="btn btn-outline-light" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
						<button class="btn btn-outline-light" id="delbtn"><i class="fa fa-check"></i> Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>