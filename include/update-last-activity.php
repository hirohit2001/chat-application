<?php
    
    include('connection.php');

    session_start();
    
    $val = $_SESSION['login_details_id'];
    $query = "update login_details set last_activity = now() where login_details_id = $val";
    mysqli_query($con, $query);
?>