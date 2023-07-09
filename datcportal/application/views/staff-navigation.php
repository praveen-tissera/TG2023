
<?php 
    if(isset($this->session->userdata('user_detail')['user-wise-menu'])){
        $userMenu = $this->session->userdata('user_detail')['user-wise-menu'];
            echo '<ul class="nav justify-content-center bg-warning">';
            foreach ($userMenu as $key => $value) {
               echo  '<li class="nav-item">';
                    echo '<a class="nav-link active text-dark" href="'. base_url('user/'.$key) . '">'.$value .'</a>';
                echo '</li>';
            }
            echo '</ul>';
            echo '<hr>';
    }
?>

