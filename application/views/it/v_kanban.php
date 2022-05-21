<div class="content-wrapper kanban">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Workspace Board</h1>
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
							<div class=" card-header">
								<h5 class="card-title"><?= $row->header ?></h5>
								<div class="card-tools">
									<a href="modal Edit" class="btn btn-tool">
										<i class="fas fa-pen"></i>
									</a>
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-plus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<pre class="p-0 m-0"><?= $row->body ?></pre>
							</div>
						</div>
					<?php endforeach; ?>
					<button class="btn btn-block btn-light btn-sm"><i class="fa fa-plus"></i>&nbsp;Add a card</button>
				</div>
			</div>

			<div class="card card-row card-default">
				<div class="card-header bg-info">
					<h3 class="card-title">
						In Progress
					</h3>
				</div>
				<div class="card-body">
					<div class="card card-info card-outline collapsed-card">
						<div class="card-header">
							<h5 class="card-title">Update Readme</h5>
							<div class="card-tools">
								<a href="#" class="btn btn-tool">
									<i class="fas fa-pen"></i>
								</a>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<p>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
								Aenean commodo ligula eget dolor. Aenean massa.
								Cum sociis natoque penatibus et magnis dis parturient montes,
								nascetur ridiculus mus.
							</p>
						</div>
					</div>
					<button class="btn btn-block btn-light btn-sm"><i class="fa fa-plus"></i>&nbsp;Add a card</button>
				</div>
			</div>

			<div class="card card-row card-success">
				<div class="card-header">
					<h3 class="card-title">
						Done
					</h3>
				</div>
				<div class="card-body">
					<div class="card card-success card-outline collapsed-card">
						<div class="card-header">
							<h5 class="card-title">Create repo</h5>
							<div class="card-tools">
								<a href="#" class="btn btn-tool">
									<i class="fas fa-pen"></i>
								</a>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<p>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
								Aenean commodo ligula eget dolor. Aenean massa.
								Cum sociis natoque penatibus et magnis dis parturient montes,
								nascetur ridiculus mus.
							</p>
						</div>
					</div>
					<button class="btn btn-block btn-light btn-sm"><i class="fa fa-plus"></i>&nbsp;Add a card</button>
				</div>
			</div>

			<div class="card card-row card-danger">
				<div class="card-header">
					<h3 class="card-title">
						Failed
					</h3>
				</div>
				<div class="card-body">
					<div class="card card-danger card-outline collapsed-card">
						<div class="card-header">
							<h5 class="card-title">Create repo</h5>
							<div class="card-tools">
								<a href="#" class="btn btn-tool">
									<i class="fas fa-pen"></i>
								</a>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<p>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
								Aenean commodo ligula eget dolor. Aenean massa.
								Cum sociis natoque penatibus et magnis dis parturient montes,
								nascetur ridiculus mus.
							</p>
						</div>
					</div>
					<button class="btn btn-block btn-light btn-sm"><i class="fa fa-plus"></i>&nbsp;Add a card</button>
				</div>
			</div>

		</div>
	</section>
</div>