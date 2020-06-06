<?php
    include('connection.php');
    session_start();

    $chat_message_id = $_POST['chat_message_id'];

    $query = "update chat_message set chat_message = 'This message was deleted', chat_media = 'This message was deleted', delete_status = 1 where chat_message_id = $chat_message_id";
    mysqli_query($con, $query);
?>