<?php $this->load->view('header'); ?>
    <body>
    <?php $this->load->view('top-navigation'); ?>
    <?php $this->load->view('staff-navigation'); ?>
    <header class="bg-primary py-5 mb-5 banner">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12 banner-content-wrapper">
          <h1 class="display-4 text-white mt-5 mb-2 text-center">Create Tech Academy</h1>
          <p class="lead mb-5 text-white-50 text-center">An experienced young team who are eager to build carrier of our young minds on computer programming and cutting-edge technologies. We offer ICT courses from age 10 to undergraduate with affordable price.</p>
        </div>
      </div>
    </div>
  </header>
      
        <div class="container">
            <div class="row center-title mb-5">
                <div class="col-6">
                    <img src="<?php echo base_url('assets/img/aboutus.jpg'); ?>" class="img-fluid"  alt="">
                </div>
                <div class="col-6">
                    <h2 class="display-4 mt-5">Who We Are</h2>
                    <p class="text-left">
                    Create Tech Academy is a private and a training Institute which is established in year 2018 which implements programs to increase ICT knowledge of our students.
                    </p>
                   
                </div>
            </div>
            <div class="row center-title my-5" id="courseview">
                <div class="col-md-12">
                    <h2 class="display-4 text-left mt-5" >Courses we offer</h2>
                    
                   
                </div>
            </div>
            <div class="row">
            <div class="col-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        
                        <img src="<?php echo base_url('assets/img/diploma.jpg'); ?>" style="height: 169px;
    width: 176px;" class="card-img img-fluid"  alt="">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">Diploma Coures</h2>
                            <p class="card-text">
                              </p>
                            <a href="<?php echo base_url('user/showCourse/diploma'); ?>" class="btn btn-info">view all</a>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="<?php echo base_url('assets/img/training.jpg'); ?>" class="card-img img-fluid"  alt="">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">Training Courses</h2>
                            <p class="card-text"></p>
                            <a href="<?php echo base_url('user/showCourse/training'); ?>" class="btn btn-info">view all</a>
                        </div>
                        </div>
                    </div>
                </div>

            </div>

            </div>

            <div class="row my-5">
                <div class="col-12">
                <h2 class="display-4 text-left mt-5" id="contactinfo">Contact Info</h2>
                </div>
                <div class="col-12">
                <div class="wow fadeInUp contact-info" >
                         <div class="section-title">
                              
                                    </div>
                         
                         <p>240/3 Hokandara Road, Thalawathugoda</p>
                         <p> <a href="mailto:info@company.com">info@cta.com</a></p>
                         <p> +94(0)112516800</p>
                    </div>
                </div>

            </div>
            
        
            
            <div class="text-center">
                <!-- <a href="#" class="btn btn-lg btn-theme-bg">More about our Services <i class="glyphicon glyphicon-circle-arrow-right"></i></a> -->
            </div>
        </div>
        

        

        
       

        <?php $this->load->view('footer'); ?>