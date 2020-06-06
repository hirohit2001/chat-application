<?php
    include('connection.php');
    session_start();


    $from_user_id = $_POST['from_user_id'];
    $to_user_id = $_SESSION['user_id'];

    $query = "update chat_message set status = 1 where (status = 0) and (from_user_id = $from_user_id and to_user_id = $to_user_id)";
    mysqli_query($con, $query);
?>