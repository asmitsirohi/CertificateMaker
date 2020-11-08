<?php
    session_start();
    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
        header('location:index.php');
    }

    session_unset();
    session_destroy();
    header('location:index.php');
?>