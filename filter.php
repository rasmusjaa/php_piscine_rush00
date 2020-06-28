<?php
    session_start();
    if (!$_SESSION['filter']) {
        $_SESSION['filter'] = '';
    }
    //$_SESSION['basket'] = null;
    $_SESSION['filter'] = $_GET['category'];
    header("Location: index.php");
?>
