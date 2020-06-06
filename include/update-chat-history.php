<?php
    include('connection.php');
    session_start();

    $from_user_id = $_SESSION['user_id'];
    $to_user_id = $_POST['to_userid'];

    $query = "select * from chat_message where (to_user_id = $to_user_id and from_user_id = $from_user_id) or (to_user_id = $from_user_id and from_user_id = $to_user_id) order by time_stamp DESC LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    echo $row['chat_message_id'];
?>