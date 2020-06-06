<?php
    include('connection.php');
    session_start();

    if(isset($_SESSION['user_id']))
    {
        header('location:http://localhost/examples/mychat/include/index.php');
    }

    $message = " ";
    
    
    if(isset($_POST['sign-in']))
    {
        $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
        $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
        
        $query = "select * from users where email = '$email'";
        $res = mysqli_query($con, $query);
        $num = mysqli_num_rows($res);
        $row = mysqli_fetch_array($res);
        
        if($num > 0)
        {
            if($password == $row['password'])
            {   
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                
                $val = $row['user_id'];
                $query = "insert into login_details(user_id) values($val)";
                mysqli_query($con, $query);
                
                $_SESSION['login_details_id'] = mysqli_insert_id($con);
                
                header('location:http://localhost/examples/mychat/include/index.php');
            }
            else
            {
                $message = "Please enter correct password!";
            }
        }
        else
        {
            $message = "Please enter valid email and password!";
        } 
    }
?>