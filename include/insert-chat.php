<?php
    include('connection.php');
    session_start();

    $to_user_id = $_POST['to_userid']; 
    $from_user_id = $_SESSION['user_id'];

    if(!empty($_POST['message']))
    {
        $message = htmlentities(mysqli_real_escape_string($con, $_POST['message']));
    }

    if(!empty($_FILES['share_file']))
    {
        $file = $_FILES['share_file'];
        
        $file_name = $file['name'];
        
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $fileNewName = uniqid('FILE_', false).".".$extension;

        $path = "../media/".$fileNewName;

        if(!move_uploaded_file($file['tmp_name'], $path))
        {
            exit();
        }
    }

    if(!empty($message) and !empty($fileNewName))
    {
        $query = "insert into chat_message(to_user_id, from_user_id, chat_message, chat_media) values($to_user_id, $from_user_id, '$message', '$fileNewName')";
        mysqli_query($con, $query);
    }
    elseif(!empty($message))
    {
        $query = "insert into chat_message(to_user_id, from_user_id, chat_message) values($to_user_id, $from_user_id, '$message')";
        mysqli_query($con, $query);    
    }
    else
    {
        $query = "insert into chat_message(to_user_id, from_user_id, chat_media) values($to_user_id, $from_user_id, '$fileNewName')";
        mysqli_query($con, $query);
    }
?>