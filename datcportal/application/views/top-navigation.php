<!-- This is general navigation comming on top of the page -->
    <div class="container">
            <div class="top-bar py-3">
                <div class="row">
                    <div class="col-md-7 hidden-xs hidden-sm">
                        <span>Create Tech Academy</span>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="top-bar-right">
                            <?php 
                                if(isset($this->session->userdata('user_detail')['type']) && ($this->session->userdata('user_detail')['type'] == 'admin' || $this->session->userdata('user_detail')['type'] == 'coordinator')){
                                    echo '<a class="btn btn-danger" id="appointment" href="'. base_url('/user/pendingOnlineRegistration') .'">View Pending Registrations</a>';
                                }else{
                                    echo '<a class="btn btn-danger" id="appointment" href="'. base_url('/#courseview') .'">Register to a course</a>';
                                }
                            ?>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <!-- Static navbar -->
        <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-dark py-0">
            <div class="container">
               
                <div id="navbarNav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mr-auto">
                    <?php $dashboad_active = ($this->session->current_menu == 'index') ? 'text-dark bg-warning' : 'text-white'; ?>
                        <li class="nav-item active"><a class="<?php echo $dashboad_active ?> nav-link" href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="nav-item"><a class="text-white nav-link" href="<?php echo base_url(); ?>#courseview">Courses</a></li>

                        <?php $dashboad_active = ($this->session->current_menu == 'verification') ? 'text-dark bg-warning' : 'text-white'; ?>

                        <li class="nav-item"><a class=" <?php echo $dashboad_active ?> nav-link" href="<?php echo base_url('/user/verification') ?>">Certificate Verification</a></li>
                        
                        <li class="nav-item"><a class="text-white nav-link" href="#contactinfo">Contact Us</a></li>
                       
                        <?php 
                            
                            if(isset($this->session->userdata['user_detail']['login'])){
                               
                                $userType = $this->session->userdata['user_detail']['type'];
                                $dashboad_active = ($this->session->current_menu == 'dashboard') ? 'text-dark bg-warning' : 'text-white';

                                if($userType == 'admin' || $userType  == 'coordinator'){
                                    echo "<li class='nav-item'><a class='$dashboad_active nav-link' href='";
                                    echo base_url('/user/staffDashBoard');
                                    echo "'>Dashboard</a></li>";
                                }else if($userType == 'student' || $userType  == 'trainer'){
                                    echo "<li class='nav-item'><a class='$dashboad_active nav-link' href='";
                                    echo base_url('/user/clientDashBoard');
                                    echo "'>Dashboard</a></li>";
                                }
                                echo "<li class='nav-item'><a class='text-white nav-link' href='";
                                echo base_url('/user/logoutUser/'.$userType);
                                echo "'>log out</a></li>";
                                    
                                
                            }
                            else{
                                echo "<li class='nav-item'><a class='text-white nav-link' href='";
                                echo base_url('/user/userLogin');
                                echo "'>log in</a></li>";
                            }
                        ?>
                        
                        
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>


        




