<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Mini Games</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Mini Games</li>
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
			</div>
		</div>
	</section>
</div>

<script>
	class Start {
		constructor() {
			this.playerName = "Player"
			this.botName = "bot"
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
