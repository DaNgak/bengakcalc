<?php 
    session_start();

    if ( !isset($_SESSION["login"]) ){ 
        header("Location: ../loginregis/");
        exit;
    }

    if ( !isset($_SESSION["id"]) ){ 
        header("Location: ../loginregis/");
        exit;
    }

    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: ../loginregis/");
    exit;
?>