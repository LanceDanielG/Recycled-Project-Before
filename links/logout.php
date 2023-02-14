<?php
    session_start();
    if(isset($_SESSION['username']) and $_SESSION['username']){
        session_unset();
        header("LOCATION: /Mommy/index.php");
        die();
    }
    if(isset($_SESSION['logged']) and $_SESSION['logged']){
        session_unset();
        header("LOCATION: /Mommy/admin-login.php");
        die();
    }
?>