<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Contacts</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Contact</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?php echo strtoupper($it1->posisi) ?>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b><?php echo $it1->nama; ?></b></h2>
                    <p class="text-muted text-sm"><b>About: </b> <?php echo $it1->about; ?> </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $it1->alamat; ?> </li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : 0<?php echo $it1->no_hp; ?> </li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="<?php echo base_url() . 'gambar/contact/' . $it1->foto; ?>" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="https://wa.me/62<?php echo $it1->no_hp; ?>?text=Hallo%20kakak%20" class="btn btn-sm bg-teal" rel="noopener" target="_blank">
                    <i class="fas fa-comments"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?php echo strtoupper($it2->posisi) ?>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b><?php echo $it2->nama; ?></b></h2>
                    <p class="text-muted text-sm"><b>About: </b><?php echo $it2->about; ?></p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $it2->alamat; ?> </li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : 0<?php echo $it2->no_hp; ?> </li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="<?php echo base_url() . 'gambar/contact/' . $it2->foto; ?>" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="https://wa.me/62<?php echo $it2->no_hp; ?>?text=Hallo%20kakak%20" class="btn btn-sm bg-teal" rel="noopener" target="_blank">
                    <i class="fas fa-comments"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?php echo strtoupper($it3->posisi) ?>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b><?php echo $it3->nama; ?></b></h2>
                    <p class="text-muted text-sm"><b>About: </b> <?php echo $it3->about; ?> </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $it3->alamat; ?> </li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : 0<?php echo $it3->no_hp; ?> </li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="<?php echo base_url() . 'gambar/contact/' . $it3->foto; ?>" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="https://wa.me/62<?php echo $it3->no_hp; ?>?text=Hallo%20kakak%20" class="btn btn-sm bg-teal" rel="noopener" target="_blank">
                    <i class="fas fa-comments"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?php echo strtoupper($it4->posisi) ?>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b><?php echo $it4->nama; ?></b></h2>
                    <p class="text-muted text-sm"><b>About: </b> <?php echo $it4->about; ?> </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $it4->alamat; ?></li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : 0<?php echo $it4->no_hp; ?></li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="<?php echo base_url() . 'gambar/contact/' . $it4->foto; ?>" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="https://wa.me/62<?php echo $it4->no_hp; ?>?text=Hallo%20kakak%20" class="btn btn-sm bg-teal" rel="noopener" target="_blank">
                    <i class="fas fa-comments"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?php echo strtoupper($it5->posisi) ?>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b><?php echo $it5->nama; ?></b></h2>
                    <p class="text-muted text-sm"><b>About: </b> <?php echo $it5->about; ?> </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $it5->alamat; ?></li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : 0<?php echo $it5->no_hp; ?></li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="<?php echo base_url() . 'gambar/contact/' . $it5->foto; ?>" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="https://wa.me/62<?php echo $it5->no_hp; ?>?text=Hallo%20kakak%20" class="btn btn-sm bg-teal" rel="noopener" target="_blank">
                    <i class="fas fa-comments"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>