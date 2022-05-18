<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Trick Or Treat</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Trick Or Treat</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-12">
					<div class="card card-success card-outline">
						<div class="card-body">
							<div class="summary shadow">
								<h2 class="title">MATCH RESULT</h2>
								<br />
								<h1 id="inGame"></h1>
								<h3 id="result"></h3>
							</div>
							<div class="games">
								<div class="option" onclick="pickOption('🖐')">🖐</div>
								<div class="option" onclick="pickOption('✌')">✌</div>
								<div class="option" onclick="pickOption('✊')">✊</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="card card-warning card-outline shadow">
						<div class="card-header">
							<h3 class="card-title">Barcode Generator</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-warning" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-danger" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<?php echo form_open('dashboard/generate') ?>
							<div class="input-group mb-2">
								<input type="number" class="form-control" placeholder="Enter.." name="keyword" value="<?= html_escape($detail) ?>" required>
								<div class="input-group-append">
									<button class="btn btn-outline-warning" type="submit">Generate!</button>
								</div>
							</div>
							<?php echo form_close() ?>
							<span class="d-flex justify-content-center">
								<?= $generate ?>
							</span>
							<small class="d-flex justify-content-center"><?= $detail ?></small>
						</div>
					</div>

					<div class="card card-info card-outline shadow">
						<div class="card-header">
							<h3 class="card-title">Qrcode Generator</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-warning" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-icon btn-circle btn-danger" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<?php echo form_open('dashboard/generateQR') ?>
							<div class="input-group mb-2">
								<input type="text" class="form-control" placeholder="Enter.." name="keywordqr" value="<?= html_escape($detailqr) ?>" required>
								<div class="input-group-append">
									<button class="btn btn-outline-info" type="submit">Generate!</button>
								</div>
							</div>
							<?php echo form_close() ?>
							<span class="d-flex justify-content-center">
								<?= $generateqr ?>
							</span>
							<small class="d-flex justify-content-center"><?= $detailqr ?></small>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	class Start {
		constructor() {
			this.playerName = " Player"
			this.botName = "Bot"
			this.playerOption;
			this.botOption;
			this.winner = ""
		}
		get getBotOption() {
			return this.botOption;
		}
		set setBotOption(option) {
			this.botOption = option;
		}
		get getPlayerOption() {
			return this.playerOption
		}
		set setPlayerOption(option) {
			this.playerOption = option;
		}
		botBrain() {
			const option = ["🖐", "✌", "✊"];
			const bot = option[Math.floor(Math.random() * option.length)];
			return bot;
		}
		winCalculation() {
			if (this.botOption == "🖐" && this.playerOption == "✌") {
				return this.winner = this.playerName
			} else if (this.botOption == "🖐" && this.playerOption == "✊") {
				return this.winner = this.botName;
			} else if (this.botOption == "✌" && this.playerOption == "🖐") {
				return this.winner = this.botName;
			} else if (this.botOption == "✌" && this.playerOption == "✊") {
				return this.winner = this.playerName
			} else if (this.botOption == "✊" && this.playerOption == "🖐") {
				return this.winner = this.playerName
			} else if (this.botOption == "✊" && this.playerOption == "✌") {
				return this.winner = this.botName;
			} else {
				return this.winner = "SERI"
			}
		}
		matchResult() {
			if (this.winner != "SERI") {
				return `${this.winner} MENANG!`;
			} else {
				return `WAAA ${this.winner}, GAK ADA YG MENANG 🤪`;
			}
		}
	}

	function pickOption(params) {
		const start = new Start();
		start.setPlayerOption = params;
		start.setBotOption = start.botBrain();
		start.winCalculation();
		const inGame = document.getElementById("inGame");
		const result = document.getElementById("result");
		inGame.textContent = "..."
		result.textContent = "..."
		setTimeout(() => {
			inGame.textContent = `${start.getPlayerOption} VS ${start.getBotOption}`
			result.textContent = start.matchResult();
		}, 1500);

	}
</script>