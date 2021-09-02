<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Inquiry
			<small>Tambah Inquiry</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/inquiry'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Inquiry</h3>
					</div>
					<div class="box-body">
						<form method="post" action="<?php echo base_url('dashboard/inquiry_aksi') ?>">
							<div class="box-body">
								<div class="form-group">							
									<label>No Inquiry</label>
										<?php 
											$inquiry_id=$this->db->select('inquiry_id')->order_by('inquiry_id',"desc")->limit(1)->get('inquiry')->row();
										?>
									<input type="text" name="inquiry_id" readonly class="form-control" value=<?php echo $inquiry_id->inquiry_id+1 ?> >
									<?php echo form_error('inquiry_id'); ?>
								</div>
								<div class="form-group">
									<label>Nama</label>
										<?php 
											$id_user = $this->session->userdata('id');
											$sales = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
										?>
									<input type="text" name="sales" readonly class="form-control" value=<?php echo $sales->pengguna_nama ?> >
									<?php echo form_error('sales'); ?>
								</div>
								<div class="form-group">
									<label>Tanggal</label>
									<?php 
										$now = $this->load->helper('date');
										$format = "%Y-%m-%d %H:%i:%s";
									?>
									<input type="datetime" name="tanggal" readonly class="form-control" value="<?php echo mdate($format); ?>">
									<?php echo form_error('tanggal'); ?>
								</div>
								<div class="form-group">
									<label>Brand Produk</label>
									<select class="form-control" name="brand">
										<option value="">- Pilih Brand -</option>
											<option value="EATON">EATON</option>
											<option value="EATON AEROQUIP">EATON AEROQUIP</option>
											<option value="EATON AIRFLEX">EATON AIRFLEX</option>
											<option value="EATON CHARLYNN">EATON CHARLYNN</option>
											<option value="EATON HYDROKRAFT">EATON HYDROKRAFT</option>
											<option value="EATON INTERNORMEN">EATON INTERNORMEN</option>
											<option value="EATON JEIL">EATON JEIL</option>
											<option value="EATON MOELLER">EATON MOELLER</option>
											<option value="EATON NIHON SPINDLE">EATON NIHON SPINDLE</option>
											<option value="EATON SEHYCO">EATON SEHYCO</option>
											<option value="EATON VICKERS">EATON VICKERS</option>
											<option value="EATON WALTERSCHIED">EATON WALTERSCHIED</option>
											<option value="EATON WINNER">EATON WINNER</option>
											<option value="TOKYO KEIKI">TOKYO KEIKI</option>
											<option value="MP FILTRI">MP FILTRI</option>
											<option value="NACOL">NACOL</option>
											<option value="STAUFF">STAUFF</option>
											<option value="SUN HYDRAULICS">SUN HYDRAULICS</option>
											<option value="BUCHER HYDRAULICS">BUCHER HYDRAULICS</option>
											<option value="HYDROLEDUC">HYDROLEDUC</option>
											<option value="NIHON SPEED">NIHON SPEED</option>
											<option value="WALVOIL">WALVOIL</option>
											<option value="VOITH TURBO">VOITH TURBO</option>
											<option value="SETTIMA">SETTIMA</option>
											<option value="AFK">AFK</option>
											<option value="AIRTAC">AIRTAC</option>
											<option value="AMCA">AMCA</option>
											<option value="ARWAY">ARWAY</option>
											<option value="ASB">ASB</option>
											<option value="ASCO">ASCO</option>
											<option value="ASHUN">ASHUN</option>
											<option value="ATOS">ATOS</option>
											<option value="ATT">ATT</option>
											<option value="AUSCO">AUSCO</option>
											<option value="AUTONICS">AUTONICS</option>
											<option value="AXIAL">AXIAL</option>
											<option value="BALFLEX">BALFLEX</option>
											<option value="BENCHMARK">BENCHMARK</option>
											<option value="BEST FLEX">BEST FLEX</option>
											<option value="BOHMER KUGELHAHNE">BOHMER KUGELHAHNE</option>
											<option value="BOLOGNA">BOLOGNA</option>
											<option value="BONFIGLIOLI">BONFIGLIOLI</option>
											<option value="BRAND HYDRAULICS">BRAND HYDRAULICS</option>
											<option value="BREVINI">BREVINI</option>
											<option value="BRIDGESTONE">BRIDGESTONE</option>
											<option value="BUCHER HIDROIRMA">BUCHER HIDROIRMA</option>
											<option value="CALZONI">CALZONI</option>
											<option value="CATERPILLAR">CATERPILLAR</option>
											<option value="CHEN YING">CHEN YING</option>
											<option value="CHYUN TSEH">CHYUN TSEH</option>
											<option value="CKD">CKD</option>
											<option value="COMATROL">COMATROL</option>
											<option value="COOLBIT">COOLBIT</option>
											<option value="CORKEN">CORKEN</option>
											<option value="CROSS HYDRAULICS">CROSS HYDRAULICS</option>
											<option value="DAIKIN">DAIKIN</option>
											<option value="DANFOSS">DANFOSS</option>
											<option value="DATA">DATA</option>
											<option value="DELTA">DELTA</option>
											<option value="DELTROL FLUID">DELTROL FLUID</option>
											<option value="DEUTZ">DEUTZ</option>
											<option value="DIZERU">DIZERU</option>
											<option value="DONALDSON">DONALDSON</option>
											<option value="DOOSAN">DOOSAN</option>
											<option value="DROTROL">DROTROL</option>
											<option value="DUFFLIED">DUFFLIED</option>
											<option value="DUPLOMATIC">DUPLOMATIC</option>
											<option value="DURAPACK">DURAPACK</option>
											<option value="DYNACOOL">DYNACOOL</option>
											<option value="DYNAMIC OIL">DYNAMIC OIL</option>
											<option value="EBARA">EBARA</option>
											<option value="EMC">EMC</option>
											<option value="ENERPAC">ENERPAC</option>
											<option value="EURODRILL">EURODRILL</option>
											<option value="EUROPACK">EUROPACK</option>
											<option value="FESTO">FESTO</option>
											<option value="FLEETGUARD">FLEETGUARD</option>
											<option value="FLOWLINE">FLOWLINE</option>
											<option value="FLUIDYNE">FLUIDYNE</option>
											<option value="FMC">FMC</option>
											<option value="FUJI">FUJI</option>
											<option value="GEMELS">GEMELS</option>
											<option value="GREEN">GREEN</option>
											<option value="HASKEL">HASKEL</option>
											<option value="HAWEI">HAWEI</option>
											<option value="HERYIH">HERYIH</option>
											<option value="HI POWER">HI POWER</option>
											<option value="HIAB">HIAB</option>
											<option value="HITACHI">HITACHI</option>
											<option value="HOF">HOF</option>
											<option value="HYDAC">HYDAC</option>
											<option value="HYDRAFORCE">HYDRAFORCE</option>
											<option value="HYDRECO POWAUTO">HYDRECO POWAUTO</option>
											<option value="HYSTAR">HYSTAR</option>
											<option value="HYVA">HYVA</option>
											<option value="IBS">IBS</option>
											<option value="IFM">IFM</option>
											<option value="IMT">IMT</option>
											<option value="INI HYDRAULIC">INI HYDRAULIC</option>
											<option value="INTEGRAL">INTEGRAL</option>
											<option value="INTERMOT">INTERMOT</option>
											<option value="INTERNORMEN">INTERNORMEN</option>
											<option value="JAGUAR">JAGUAR</option>
											<option value="JEONGANG">JEONGANG</option>
											<option value="JOHN S. BARNES">JOHN S. BARNES</option>
											<option value="JOYANG">JOYANG</option>
											<option value="JSCC">JSCC</option>
											<option value="KAIYUAN">KAIYUAN</option>
											<option value="KAMUI">KAMUI</option>
											<option value="KANA">KANA</option>
											<option value="KAWASAKI">KAWASAKI</option>
											<option value="KAYABA">KAYABA</option>
											<option value="KITZ">KITZ</option>
											<option value="KOMATSU">KOMATSU</option>
											<option value="KOYO">KOYO</option>
											<option value="KREKEN">KREKEN</option>
											<option value="KTR">KTR</option>
											<option value="LINDE HYDRAULICS">LINDE HYDRAULICS</option>
											<option value="LIQUIP">LIQUIP</option>
											<option value="M+S HYDRAULIC">M+S HYDRAULIC</option>
											<option value="MAGNUM">MAGNUM</option>
											<option value="MARZOCCHI">MARZOCCHI</option>
											<option value="METSO">METSO</option>
											<option value="MH HYDRAULICS">MH HYDRAULICS</option>
											<option value="MITSUBOSHI NABCO">MITSUBOSHI NABCO</option>
											<option value="MOELLER">MOELLER</option>
											<option value="MONDEA">MONDEA</option>
											<option value="MS HYDRAULIC">MS HYDRAULIC</option>
											<option value="NABCO">NABCO</option>
											<option value="NACHI">NACHI</option>
											<option value="NAGANO KEIKI">NAGANO KEIKI</option>
											<option value="NANNO'S">NANNO'S</option>
											<option value="NOK">NOK</option>
											<option value="NOP">NOP</option>
											<option value="NORTHMAN">NORTHMAN</option>
											<option value="NTN">NTN</option>
											<option value="OILGEAR">OILGEAR</option>
											<option value="OILWAY">OILWAY</option>
											<option value="OLAER">OLAER</option>
											<option value="OLEO MOTOR">OLEO MOTOR</option>
											<option value="OMFB">OMFB</option>
											<option value="OMRON">OMRON</option>
											<option value="PAILIS">PAILIS</option>
											<option value="PARKER">PARKER</option>
											<option value="PERKINS">PERKINS</option>
											<option value="PIONEER">PIONEER</option>
											<option value="POCLAIN HYDRAULICS">POCLAIN HYDRAULICS</option>
											<option value="REXROTH">REXROTH</option>
											<option value="RONZIO">RONZIO</option>
											<option value="ROTEX">ROTEX</option>
											<option value="ROTODEL">ROTODEL</option>
											<option value="RYCO">RYCO</option>
											<option value="SAI">SAI</option>
											<option value="SAIFRANCE">SAIFRANCE</option>
											<option value="SBD">SBD</option>
											<option value="SC HYDRAULIC">SC HYDRAULIC</option>
											<option value="SCHNEIDER">SCHNEIDER</option>
											<option value="SHIMADZU">SHIMADZU</option>
											<option value="SHM">SHM</option>
											<option value="SIEMENS">SIEMENS</option>
											<option value="SIRAI">SIRAI</option>
											<option value="SKON">SKON</option>
											<option value="SMC">SMC</option>
											<option value="SMITH HYDRAULIC">SMITH HYDRAULIC</option>
											<option value="SOUTHERNCROSS">SOUTHERNCROSS</option>
											<option value="STNC">STNC</option>
											<option value="SUCO">SUCO</option>
											<option value="SUMITOMO">SUMITOMO</option>
											<option value="SWAGELOK">SWAGELOK</option>
											<option value="TAICIN">TAICIN</option>
											<option value="TECO">TECO</option>
											<option value="TEMA">TEMA</option>
											<option value="TIMKEN">TIMKEN</option>
											<option value="TOGNELLA">TOGNELLA</option>
											<option value="TORISHIMA">TORISHIMA</option>
											<option value="TOYO OKI">TOYO OKI</option>
											<option value="TRIBOMAR">TRIBOMAR</option>
											<option value="TRIPLE R">TRIPLE R</option>
											<option value="UCC">UCC</option>
											<option value="UNIFLEX">UNIFLEX</option>
											<option value="UNITED">UNITED</option>
											<option value="VICKING">VICKING</option>
											<option value="VOLVO">VOLVO</option>
											<option value="VON RUDEN">VON RUDEN</option>
											<option value="WEBTEC">WEBTEC</option>
											<option value="WIEBROCK">WIEBROCK</option>
											<option value="WIKAI">WIKAI</option>
											<option value="WINNER">WINNER</option>
											<option value="XKGAUGE">XKGAUGE</option>
											<option value="YEOSHE">YEOSHE</option>
											<option value="YOESHI">YOESHI</option>
											<option value="YOKOGAWA">YOKOGAWA</option>
											<option value="YOULI">YOULI</option>
											<option value="YUKEN">YUKEN</option>
											<option value="ZUWA">ZUWA</option>
									</select>
									<?php echo form_error('brand'); ?>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<input type="text" name="desc" class="form-control" placeholder="input Desc..">
									<?php echo form_error('desc'); ?>
								</div>
									<div class="form-group">
									<label>Quantity</label>
									<input type="number" name="qty" class="form-control" placeholder="input qty...">
									<?php echo form_error('qty'); ?>
								</div>
								<div class="form-group">
									<label>Deadline</label>
									<input type="date" name="deadline" class="form-control" placeholder="input deadline ..">
									<?php echo form_error('deadline'); ?>
								</div>
								<div class="form-group">
									<label>Note</label>
									<textarea name="keter" class="form-control" rows="3" placeholder="input  .."></textarea>
									<?php echo form_error('keter'); ?>
								</div>
								<div class="form-group">
									<label>Request</label>
									<select class="form-control" name="request">
										<option value="">- Pilih Request -</option>
										<option value="PRICE+LT">PRICE+LT</option>
										<option value="PRICE">PRICE</option>
										<option value="LT">LT</option>
										<option value="STOCK">STOCK</option>
										<option value="PRICE+LT+STOCK">PRICE+LT+STOCK</option>
										<option value="COO">COO</option>
										<option value="CATALOGUE">CATALOGUE</option>
										<option value="DESIGN">DESIGN</option>
									</select>
									<?php echo form_error('request'); ?>
								</div>
							</div>
							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
