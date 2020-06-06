<?php
    include('connection.php');
    session_start();

    $user_id = $_SESSION['user_id'];

    if(isset($_FILES['file']))
    {
        $image = $_FILES['file'];
        
        $file_name = $_FILES['file']['name'];
        
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $fileNewName = uniqid('IMG_', false).".".$extension;

        $path = "../profile-pic/".$fileNewName;

        move_uploaded_file($image['tmp_name'], $path);
        
        $query = "update users set profile_pic = '$fileNewName' where user_id = $user_id";
        mysqli_query($con, $query);
    }

    $query = "select * from users where user_id = $user_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $profile_pic = $row['profile_pic'];

    echo "<img src = '../profile-pic/".$profile_pic."' height=300px width=300px style='border-radius: 100%'>";
?>