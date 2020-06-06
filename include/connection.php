<?php
    $con = mysqli_connect('localhost', 'root', '') or die('Connection could not be established');
    mysqli_select_db($con, 'mychat');
?>