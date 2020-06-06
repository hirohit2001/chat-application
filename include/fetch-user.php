<?php
    include('connection.php');

    session_start();


    $val = $_SESSION['user_id'];
    $query = "select * from users where user_id != $val";
    $result = mysqli_query($con, $query);

    $output = "<table class='table'>";


    function fetch_user_last_activity($user_id, $con)
    {
        $query = "select * from login_details where user_id = $user_id order by last_activity DESC LIMIT 1";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        
        return $row['last_activity'];
    }

    function count_unseen_msg($from_user_id, $to_user_id, $con)
    {
        $query = "select * from chat_message where to_user_id = $to_user_id and from_user_id = $from_user_id and status = 0";
        $result = mysqli_query($con, $query);
        $num = mysqli_num_rows($result);
        
        return $num;
    }


    foreach($result as $row)
    {   
        //For Online and Offline status
        date_default_timezone_set('Asia/Kolkata'); 
        
        $status = " ";
        $current_timestamp = strtotime(date('y-m-d h:i:s').'-10 second');
        $current_timestamp = date('y-m-d h:i:s', $current_timestamp);
        
        $last_activity = fetch_user_last_activity($row['user_id'], $con);
        $last_activity = strtotime($last_activity);
        $last_activity = date('y-m-d h:i:s', $last_activity);
        
        $username = $row['username'];
        $userid = $row['user_id'];
        $profile_pic = $row['profile_pic'];
        
        $status = $last_activity." ".$current_timestamp;
        
        if(strtotime($last_activity) > strtotime($current_timestamp) )
        {
            $status = '<span class="badge badge-success">Online<span>';
        }
        else
        {
            $status = '<span class="badge badge-danger">Offline</span>';
        }
        
        
        //For Typing... notification
        $is_typing = " ";
        $check_status = "select * from login_details where user_id = ".$row['user_id']." order by last_activity DESC LIMIT 1";
        $login_details_result = mysqli_query($con, $check_status);
        $login_details = mysqli_fetch_array($login_details_result);
        if($login_details['is_typing'] == 1 and $login_details['to_user_id'] == $_SESSION['user_id'])
        {
            $is_typing = "<small style='font-size: 15px; font-weight: bold; color: #24CD63'>typing...</small>";
        }
        
        
        //For message notification
        $num_unseen_msg = count_unseen_msg( $row['user_id'], $_SESSION['user_id'], $con);
        if($num_unseen_msg > 0)
        {
             $num_unseen_msg = "<label class='badge badge-primary'>".$num_unseen_msg."</label>";
        }
        else
        {
            $num_unseen_msg = " ";
        }
        
        $output = $output."<tr>
                                <td><img src = '../profile-pic/".$row['profile_pic']."' height=50px width=50px style='border-radius: 100%'></td>
                                
                                <td><span class='check-profile' data-user_id=".$row['user_id'].">".$username."</span> ".$num_unseen_msg."<br>".$is_typing."</td>
                                
                                <td>".$status."</td>
                                
                                <td><button class='btn btn-success btn-sm start-chat' data-touserid=$userid data-tousername='$username' data-profile_pic='$profile_pic'>Message</button></td>
                                </tr>";
    }

    $output = $output."</table>";

    echo $output;
?>

<style>
    .badge-primary{
        background-color: #06D755;
        border-radius: 100%;
    }
    .check-profile{
        cursor: pointer;
    }
</style>