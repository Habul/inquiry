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
				<div class="box box-primary">
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
									<label>Nama Sales</label>
										<?php 
											$id_user = $this->session->userdata('id');
											$sales = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
										?>
									<input type="text" name="sales" readonly class="form-control" value="<?php echo $sales->pengguna_nama; ?> ">
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
								<div class="form-group">
									<label>Brand Produk</label>
									<select class="form-control" name="brand">
										<option value="">- Pilih Brand -</option>
											<option value="AIRTAC">AIRTAC</option>
											<option value="ALKITRONIC">ALKITRONIC</option>
											<option value="AOI">AOI</option>
											<option value="ASCO">ASCO</option>
											<option value="ATOS">ATOS</option>
											<option value="AVENTICS">AVENTICS</option>
											<option value="BEAN PUMP">BEAN PUMP</option>
											<option value="BEINLICH">BEINLICH</option>
											<option value="BENCH MARK">BENCH MARK</option>
											<option value="BOMAG">BOMAG</option>
											<option value="BONFIGLIOLI">BONFIGLIOLI</option>
											<option value="BOWMAN">BOWMAN</option>
											<option value="BREVINI">BREVINI</option>
											<option value="BUCHER">BUCHER</option>
											<option value="BUCHER (DISTRIBUTOR)">BUCHER (DISTRIBUTOR)</option>
											<option value="BUCHER (HIDROIRMA)">BUCHER (HIDROIRMA)</option>
											<option value="BUCHER (INDIA)">BUCHER (INDIA)</option>
											<option value="BUCHER SUPPLIER">BUCHER SUPPLIER</option>
											<option value="BURKERT">BURKERT</option>
											<option value="CASAPPA">CASAPPA</option>
											<option value="CATERPILLAR">CATERPILLAR</option>
											<option value="CROSS HYDRAULICS">CROSS HYDRAULICS</option>
											<option value="DAIKIN">DAIKIN</option>
											<option value="DAIKIN LOCAL">DAIKIN LOCAL</option>
											<option value="DANFOSS">DANFOSS</option>
											<option value="DELTECH">DELTECH</option>
											<option value="DELTROL LOCAL">DELTROL LOCAL</option>
											<option value="DENISON">DENISON</option>
											<option value="DINAMIC OIL">DINAMIC OIL</option>
											<option value="DOWMAX">DOWMAX</option>
											<option value="DROTROL">DROTROL</option>
											<option value="DUIJVELAAR POMPEN">DUIJVELAAR POMPEN</option>
											<option value="DUPLOMATIC">DUPLOMATIC</option>
											<option value="DYNACOOL">DYNACOOL</option>
											<option value="EATON">EATON</option>
											<option value="EATON FILTRATION">EATON FILTRATION</option>
											<option value="EATON LOCAL">EATON LOCAL</option>
											<option value="EATON SUPPLIER">EATON SUPPLIER</option>
											<option value="EBARA">EBARA</option>
											<option value="EBSRAY">EBSRAY</option>
											<option value="EMERSON">EMERSON</option>
											<option value="ENERPAC">ENERPAC</option>
											<option value="EPE">EPE</option>
											<option value="FAG">FAG</option>
											<option value="FESTO">FESTO</option>
											<option value="FLOW">FLOW</option>
											<option value="FLOWLINE">FLOWLINE</option>
											<option value="FLUIDYNE">FLUIDYNE</option>
											<option value="FUJI">FUJI</option>
											<option value="GALTECH">GALTECH</option>
											<option value="HAGGLUNDS">HAGGLUNDS</option>
											<option value="HAWE">HAWE</option>
											<option value="HEMS">HEMS</option>
											<option value="HOERBIGER">HOERBIGER</option>
											<option value="HONSBERG">HONSBERG</option>
											<option value="HYDAC">HYDAC</option>
											<option value="HYDRAFORCE">HYDRAFORCE</option>
											<option value="HYDRAFORCE LOCAL">HYDRAFORCE LOCAL</option>
											<option value="HYDRAU-FLO">HYDRAU-FLO</option>
											<option value="HYDRO LEDUC">HYDRO LEDUC</option>
											<option value="HYDROCAR">HYDROCAR</option>
											<option value="HYDROKRAFT">HYDROKRAFT</option>
											<option value="HYDROLEDUC">HYDROLEDUC</option>
											<option value="HYVA">HYVA</option>
											<option value="INI HYDRAULIC">INI HYDRAULIC</option>
											<option value="INTERMOT">INTERMOT</option>
											<option value="INTERMOT L">INTERMOT L</option>
											<option value="INTERNORMEN">INTERNORMEN</option>
											<option value="INTERPUMP">INTERPUMP</option>
											<option value="IOWA MOLD TOOLING">IOWA MOLD TOOLING</option>
											<option value="ISKRA">ISKRA</option>
											<option value="JOUCOMATIC">JOUCOMATIC</option>
											<option value="JUROP">JUROP</option>
											<option value="KAMUI">KAMUI</option>
											<option value="KAWASAKI">KAWASAKI</option>
											<option value="KAYABA">KAYABA</option>
											<option value="KCC">KCC</option>
											<option value="KOMATSU">KOMATSU</option>
											<option value="KONAN">KONAN</option>
											<option value="KRACHT">KRACHT</option>
											<option value="LINDE">LINDE</option>
											<option value="M+S HYDRAULIC">M+S HYDRAULIC</option>
											<option value="MASUDA">MASUDA</option>
											<option value="MOOG">MOOG</option>
											<option value="MOTOVARIO">MOTOVARIO</option>
											<option value="MP FILTRI">MP FILTRI</option>
											<option value="NABCO">NABCO</option>
											<option value="NABTESCO">NABTESCO</option>
											<option value="NACHI">NACHI</option>
											<option value="NACOL">NACOL</option>
											<option value="NAGANO KEIKI">NAGANO KEIKI</option>
											<option value="NAKAMURA KOKI">NAKAMURA KOKI</option>
											<option value="NANNO">NANNO</option>
											<option value="NIHON SPEED">NIHON SPEED</option>
											<option value="NIHON SPINDLE">NIHON SPINDLE</option>
											<option value="NIPPON">NIPPON</option>
											<option value="NOK">NOK</option>
											<option value="NOK LOCAL">NOK LOCAL</option>
											<option value="NOP">NOP</option>
											<option value="NORGREN">NORGREN</option>
											<option value="OILGEAR">OILGEAR</option>
											<option value="OMFB">OMFB</option>
											<option value="PENTEK">PENTEK</option>
											<option value="POCLAIN">POCLAIN</option>
											<option value="POWER TEAM">POWER TEAM</option>
											<option value="POWERFLOW">POWERFLOW</option>
											<option value="PQ CONTROLS">PQ CONTROLS</option>
											<option value="RACINE ">RACINE </option>
											<option value="RACINE (HOLLAND)">RACINE (HOLLAND)</option>
											<option value="REXROTH">REXROTH</option>
											<option value="RONZIO">RONZIO</option>
											<option value="SAI">SAI</option>
											<option value="SC HYDRAULICS">SC HYDRAULICS</option>
											<option value="SEIM">SEIM</option>
											<option value="SEN-DURE">SEN-DURE</option>
											<option value="SETTIMA">SETTIMA</option>
											<option value="SHIMADZU">SHIMADZU</option>
											<option value="SMC">SMC</option>
											<option value="STAUFF">STAUFF</option>
											<option value="SUMITOMO">SUMITOMO</option>
											<option value="SUN HYDRAULICS">SUN HYDRAULICS</option>
											<option value="SUN HYDRAULICS SUPPLIER">SUN HYDRAULICS SUPPLIER</option>
											<option value="TAISEI KOGYO">TAISEI KOGYO</option>
											<option value="TEYO">TEYO</option>
											<option value="TOBUL">TOBUL</option>
											<option value="TOKI SANGYO">TOKI SANGYO</option>
											<option value="TOKUSHU DENSO">TOKUSHU DENSO</option>
											<option value="TOKYO KEIKI">TOKYO KEIKI</option>
											<option value="TOKYO KEIKI SQP01">TOKYO KEIKI SQP01</option>
											<option value="TOYOOKI">TOYOOKI</option>
											<option value="TRIPLE R">TRIPLE R</option>
											<option value="TUROLLA">TUROLLA</option>
											<option value="VICKERS">VICKERS</option>
											<option value="VOGEL">VOGEL</option>
											<option value="VOITH">VOITH</option>
											<option value="VOITH (LOCAL)">VOITH (LOCAL)</option>
											<option value="VOITH (SUPPLIER)">VOITH (SUPPLIER)</option>
											<option value="WALVOIL">WALVOIL</option>
											<option value="WALVOIL (ITALY)">WALVOIL (ITALY)</option>
											<option value="WEBTEC">WEBTEC</option>
											<option value="YOKOGAWA">YOKOGAWA</option>
											<option value="YOSHITAKE">YOSHITAKE</option>
											<option value="YUKEN">YUKEN</option>
											<option value="ZIEHL-ABEGG">ZIEHL-ABEGG</option>
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
								
							</div>
							<div class="box-footer">
								<a href="<?php echo base_url().'dashboard/inquiry'; ?>" class="btn btn-default">Kembali</a>
								<input type="submit" class="btn btn-info pull-right" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
