<?php
    if(isset($_POST['password'])) {
        $password = $_POST['password'];
        $encodedPassword = md5($password);

        $minePassword = '21232f297a57a5a743894a0e4a801fc3';
        
        if($encodedPassword == $minePassword) {
            session_start();
            $_SESSION['loggedin'] = true;
            echo true;
        } else {
            echo false;
        }
    }
?>