  <!--/ Intro Skew Star /-->
  <div id="home" class="intro route bg-image" style="background-image: url(<?php echo base_url(); ?>assets_frontend/img/IMG_1479.jpg)">
    <div class="overlay-itro"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <!--<p class="display-6 color-d">Hello, world!</p>-->
          <h1 class="intro-title mb-4"><?php echo $pengaturan->nama ?></h1>
          <p class="intro-subtitle"><span class="text-slider-items">Web Developer,Technical Support,Photography,Network Engineer </span><strong class="text-slider"></strong></p>
        </div>
      </div>
    </div>
  </div>
  <!--/ Intro Skew End /-->

  <br/>
  <br/>
  <br/>

  <!--/ Section Services Star /-->
  
  <!--/ Section Services End /-->

  <!--/ Section Portfolio Star /-->
  
	<!--/ Section Portfolio End /-->

  <!--/ Section Testimonials Star /-->
  
  <!--/ Section Blog Star /-->
  <section id="blog" class="blog-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Article
            </h3>
            <p class="subtitle-a">
              </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">

        <?php foreach($artikel as $a){ ?>
          <div class="col-md-4">
            <div class="card card-blog">
              <div class="card-img">
                <a href="<?php echo base_url().$a->artikel_slug ?>">
                  <?php if($a->artikel_sampul != ""){ ?>
                    <img src="<?php echo base_url(); ?>gambar/artikel/<?php echo $a->artikel_sampul ?>" alt="" class="img-fluid">
                  <?php } ?>
                </a>
              </div>
              <div class="card-body">
                <div class="card-category-box">
                  <div class="card-category">
                    <h6 class="category"><?php echo $a->kategori_nama ?></h6>
                  </div>
                </div>

                <h3 class="card-title"><a href="<?php echo base_url().$a->artikel_slug ?>"><?php echo $a->artikel_judul ?></a></h3>

              </div>
              <div class="card-footer">
                <div class="post-author">
                  <a href="#">
                    <span class="author"><?php echo $a->pengguna_nama; ?></span>
                  </a>
                </div>
                <div class="post-date">
                  <span class="ion-ios-clock-outline"></span> <?php echo date('d-M-Y', strtotime($a->artikel_tanggal)); ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        
      </div>
    </div>
  </section>
  <!--/ Section Blog End /-->
