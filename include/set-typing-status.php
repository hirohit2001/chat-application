<?php
    include('connection.php');

    session_start();

    $to_userid = $_POST['to_userid'];
    $is_typing = $_POST['is_typing'];

    $login_id = $_SESSION['login_details_id'];

    
    $query = "update login_details set is_typing = $is_typing where login_details_id = $login_id";
    mysqli_query($con, $query);

    $query = "update login_details set to_user_id = $to_userid where login_details_id = $login_id";
    mysqli_query($con, $query);

?>