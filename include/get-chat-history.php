<?php
    include('connection.php');
    session_start();


    $to_user_id = $_POST['to_userid'];
    $query = "select * from users where user_id = $to_user_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $to_username = $row['username'];
    $from_user_id = $_SESSION['user_id'];



    $query = "select * from chat_message where (to_user_id = $to_user_id and from_user_id = $from_user_id) or (to_user_id = $from_user_id and from_user_id = $to_user_id) order by time_stamp ASC";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);


    if($num == 0)
    {
        $output = "<div style='text-align: center; color: black; font-weight: 700'>Send a message to start the conversation<div>";
    }
    else
    {
        $output = "<ul style='list-style: none'>";
        
        foreach($result as $row)
        {
            $message = "";
            $media = "";
            
            if(!is_null($row['chat_message']))
            {
                $message = $row['chat_message'];
            }
            
            if(!is_null($row['chat_media']))
            {
                $media = $row['chat_media'];
                
                $file_name = $media;
                $file_extension = explode(".", $file_name); 
                $file_extension = end($file_extension);
                
                
                if(strcmp($file_extension,"mp4") == 0)
                {
                    
                    $media = "<div style='clear: both'><video width='320' height='240' controls><source src='../media/".$row['chat_media']."' type='video/mp4'><source src='".$row['chat_media']."' type='video/ogg'></video></div>";
                }
                elseif(strcmp($file_extension,"mp3") == 0)
                {   
                     $media = "<div style='clear: both'><audio controls><source src='../media/".$row['chat_media']."' type='audio/ogg'><source src='../media/".$row['chat_media']." type='audio/mpeg'></audio></div>";
                }
                else
                {   
                    $media = "<div style='clear: both'><img src='../media/".$row['chat_media']."' height='250px' width='250px'></div>";
                }
            }
            
            if($row['from_user_id'] == $_SESSION['user_id'])
            {
                $username = "<span class='badge badge-success'>You</span>";
                
                if($row['delete_status'] == 1)
                {
                    $message = "<em style='font-weight: lighter;'>".$message."</em>";
                    
                    $content = "<li class='to-right' style='clear: both; float: right;'>"
                                .$username."<br><span style='clear: both; float: right;' >"
                                .$message."<br><small style='clear: both; float: right; background-color: #f1f1f1; padding: 3px; border-radius: 5px;'><em>".$row['time_stamp']."</em></small></li>";
                }
                else
                {
                    $content = "<li class='to-right' style='clear: both; float: right;'>
                                <button type='button' data-to_user_id=".$row['to_user_id']." class='close delete-msg' aria-label='Close' id=".$row['chat_message_id'].">
                                <span aria-hidden='true'>&times;</span>
                                </button>"
                                .$username."<br>".$media."<span style='clear: both;'>"
                                .$message."<br>
                                <small style='clear: both; float: right; background-color: #f1f1f1; padding: 3px; border-radius: 5px;'><em>".$row['time_stamp']."</em></small></li>";         
                }
                                
                $output = $output.$content;
            }
       
            else
            {
                $username = "<span class='badge badge-warning'>".$to_username."</span>";
                
                if($row['delete_status'] == 1)
                {
                    $message = "<em style='font-weight: lighter;'>".$message."</em>";
                    
                    $content = "<li class='to-left' style='clear: both; float: left;'>"
                                .$username."<br><span style='clear: both; float: left;' >"
                                .$message."</span><br>
                                <small style='clear: both; float: right; background-color: #E1F3FA; padding: 3px; border-radius: 5px;'><em>".$row['time_stamp']."</em></small></li>";
                }
                else
                {
                    $content = "<li class='to-left' style='clear: both; float: left;'>"
                                .$username."<br>".$media."<span style='clear: both; float: left;' >"
                                .$message."</span><br>
                                <small style='clear: both; float: right; background-color: #E1F3FA; padding: 3px; border-radius: 5px;'><em>".$row['time_stamp']."</em></small></li>";
                }
                
              
                 $output = $output.$content;
            }
        }
    }
    $output = $output."</ul>";
    echo $output;
?>

<style>
    .to-left{
        background-color: #FFFFFF;
        padding: 5px;
        border-radius: 10px;
        font-size: 15px;
        min-width: 200px;
        max-width: 400px;
        margin-bottom: 5px;
        font-family: 'Montserrat';
    }
    .to-right{
        background-color: #DCF8C6;
        padding: 5px;
        border-radius: 10px;
        font-size: 15px;
        min-width: 200px;
        max-width: 400px;
        margin-bottom: 5px;
        font-family: 'Montserrat';
    }
</style>