<?php $this->load->view('header'); ?>
<?php $this->load->view('top-navigation'); ?>
<div class="container">
    <div class="row">

        <div class="col-md-offset-2 col-md-8">
    

        <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">                          
                            <li  class="active"><a href="#tab2default" data-toggle="tab">Client form for sworn translators</a></li>
                        </ul>
                </div>
               
                        
                        <div class="tab-pane fade in active" id="tab2default">
                        
                        <div class="panel-heading">
                        <h3 class="panel-title">You are required to submit accurate details</h3>
                        
                        </div>
                    <div class="panel-body">
                    <?php

                    echo form_open('user/createMoreInfo');   
                    if(form_error('gender') || form_error('birth-place') || form_error('birth-year') || form_error('father-name') || form_error('mother-name') || form_error('father-profession')){
                        echo '<div class="alert alert-danger" role="alert">';
                            echo form_error('gender');
                            echo form_error('birth-place');
                            echo form_error('birth-place');
                            echo form_error('birth-year');
                            echo form_error('father-name');
                            echo form_error('mother-name');
                            echo form_error('father-profession');
                        echo '</div>';
                        }
                        if(isset($error_message_display)){
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $error_message_display;
                            echo '</div>';
                            }
                            if(isset($success_message_display)){
                            echo '<div class="alert alert-success" role="alert">';
                            echo $success_message_display;
                            echo '</div>';
                            }


                            $data = array(
                                'type' => 'hidden',
                                'name' => 'schedule-id',
                                'class' => 'form-control',
                                'value' => $schedule_id
                                );
                                echo form_input($data);

                    echo "<fieldset>";

                    echo "<div class='form-group'>";
                    echo "<h5>Gender</h5>";
                    if(isset($user_form_details)){
                        if($user_form_details[0]->gender == 'female'){
                            $data = array(
                                'type' => 'text',
                                'name' => 'gender',                           
                                'value'=> 'male',
                                
                                );
                                echo form_radio($data);
                                echo "<label>Male</lable> ";
        
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'gender',
                                    'checked'=>true,
                                    'value'=> 'female',
                                    
                                    );
                                echo form_radio($data);
                        }else{
                            $data = array(
                                'type' => 'text',
                                'name' => 'gender',
                                'checked'=>true, 
                                'value'=> 'male',
                                );
                                echo form_radio($data);
                                echo "<label>Male</lable> ";
        
        
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'gender',
                                    'value'=> 'female',
                                    );
                                echo form_radio($data);
                        }
                    }else{
                        $data = array(
                            'type' => 'text',
                            'name' => 'gender',
                            'checked'=>true, 
                            'value'=> 'male',
                            );
                            echo form_radio($data);
                            echo "<label>Male</lable> ";
    
    
                            $data = array(
                                'type' => 'text',
                                'name' => 'gender',
                                'value'=> 'female',
                                );
                            echo form_radio($data);
                    }
                   
                           
                            echo "<label>Female</lable>";

                    echo "</div>";
                    

                            



                        echo "<div class='form-group'>";
                        if(isset($user_form_details)){
                            $data = array(
                                'type' => 'text',
                                'name' => 'birth-place',
                                'class' => 'form-control',
                                'placeholder' => 'Birth Place',
                                'value'=>$user_form_details[0]->birth_place
                                );
                        }else{
                            $data = array(
                                'type' => 'text',
                                'name' => 'birth-place',
                                'class' => 'form-control',
                                'placeholder' => 'Birth Place'
                                );
                        }
                        
                            echo form_input($data);
                        echo "</div>";



                       

                        echo "<div class='form-group'>";
                        $year = array();
                        $year[' '] = 'Birth Year';
                        for($i = 1930; $i <= 2018; $i++){
                            $year[$i] = $i;
                        }
                        
                        $options = $year;
                        $attribute = 'class="form-control specialty"';

                        if(isset($user_form_details)){
                            echo form_dropdown('birth-year', $user_form_details[0]->birth_year, ' ',$attribute);
                        }else{
                            echo form_dropdown('birth-year', $options, ' ',$attribute);
                        }
                        

                        
                        echo "</div>";

                        echo "<div class='form-group'>";
                        if(isset($user_form_details)){
                            $data = array(
                                'type' => 'text',
                                'name' => 'father-name',
                                'class' => 'form-control',
                                'placeholder' => 'Fathers Name',
                                'value' => $user_form_details[0]->father_name
                                );
                        }else{
                            $data = array(
                                'type' => 'text',
                                'name' => 'father-name',
                                'class' => 'form-control',
                                'placeholder' => 'Fathers Name'
                                );
                        }
                        
                            echo form_input($data);
                        echo "</div>";

                        echo "<div class='form-group'>";
                        if(isset($user_form_details)){
                            $data = array(
                                'type' => 'text',
                                'name' => 'mother-name',
                                'class' => 'form-control',
                                'placeholder' => 'Mothers Name',
                                'value' =>  $user_form_details[0]->mother_name
                                );
                        }else{
                            $data = array(
                                'type' => 'text',
                                'name' => 'mother-name',
                                'class' => 'form-control',
                                'placeholder' => 'Mothers Name'
                                );
                        }
                       
                            echo form_input($data);
                        echo "</div>";

                        echo "<div class='form-group'>";
                        if(isset($user_form_details)){
                            $data = array(
                                'type' => 'text',
                                'name' => 'father-profession',
                                'class' => 'form-control',
                                'placeholder' => 'Fathers Profession',
                                'value' =>  $user_form_details[0]->father_profession
                                );
                        }else{
                            $data = array(
                                'type' => 'text',
                                'name' => 'father-profession',
                                'class' => 'form-control',
                                'placeholder' => 'Fathers Profession'
                                );
                        }
                        
                            echo form_input($data);
                        echo "</div>";

                        
                        
                       
                    echo "</fieldset>";
                    echo form_submit('submit', 'Submit The Document', "class='btn btn-success btn-md btn-block'");
                    echo form_close();

                    ?>
                    </div>
                        
                        
                        </div>
                       
                        
                    </div>
                </div>
            </div>



            
        </div>
    </div>
</div>
    
   

<?php $this->load->view('footer'); ?>
   