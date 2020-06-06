<?php
    include('connection.php');
    session_start();

    $user_id = $_POST['user_id'];

    $query = "select * from users where user_id = $user_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    $profile = "<div class='remove' style='float: right; cursor: pointer;'><span class='material-icons' style='margin: 10px;'>cancel</span></div><div class='col-8' style='margin: 0px auto; padding-top: 5rem'>
                    <div class='col-5' style='margin: 0px auto;'>
                        <img src='../profile-pic/".$row['profile_pic']."' height='200px' width='200px' style='border-radius: 100px;'>
                    </div><br>
                    <table class='table'>
                        <tr style='text-align: center;'>
                            <th>Name:</th><td>".$row['username']."</td>
                        </tr>
                        <tr style='text-align: center;'>
                            <th>Country: </th><td>".$row['country']."</td>
                        </tr>
                        <tr style='text-align: center;'>
                            <th>Gender: </th><td>".$row['gender']."</td>
                        </tr>
                    </table>
                </div>";
    echo $profile;
?>