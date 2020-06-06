<?php
    session_start();
    
    session_destroy();

    header('location:http://localhost/examples/mychat/include/sign-in.php');
?>