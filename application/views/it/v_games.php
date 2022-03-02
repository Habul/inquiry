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
					<div class="card card-success card-outline direct-chat direct-chat-success shadow">
						<div class="card-header">
							<h3 class="card-title">Send chat Bot</h3>
							<div class="card-tools">
								<span title="New Messages" class="badge bg-success"></span>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="direct-chat-messages">
								<div class="direct-chat-msg">
									<div class="direct-chat-infos clearfix">
										<span class="direct-chat-name float-left">Bot</span>
									</div>
									<img class="direct-chat-img" src="<?php echo base_url(); ?>gambar/website/Untitled-1-02.png"
										alt="Message User Image">
									<div class="direct-chat-text">
										Lorem ipsum dolor sit amet.
									</div>
								</div>
								<div class="direct-chat-msg right">
									<div class="direct-chat-infos clearfix">
										<span
											class="direct-chat-name float-right"><?php echo $this->session->userdata('nama'); ?></span>
									</div>
									<img class="direct-chat-img"
										src="<?php echo base_url() . 'gambar/profile/' . $this->session->userdata('foto'); ?>"
										alt="Message User Image">
									<div class="direct-chat-text">
										Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates vel aperiam vitae qui,
										suscipit soluta libero beatae culpa mollitia aliquid!
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<form action="#" method="post">
								<div class="input-group">
									<input type="text" name="message" placeholder="Type Message ..." class="form-control">
									<span class="input-group-append">
										<button type="submit" class="btn btn-success">Send</button>
									</span>
								</div>
							</form>
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
