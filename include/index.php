<?php
    include('connection.php');
    session_start();
    
    if(!isset($_SESSION['user_id']))
    {
        header('location:http://localhost/examples/mychat/include/sign-in.php');
    }
?>


<!doctype html>
<html lang="en">
    
<head>

    <!--Bootstrap, Fonts, Icons -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    
    
    <!--Emojionarea-->
    <link rel="stylesheet" href="../css/emojionearea.min.css">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="../js/emojionearea.min.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

        
    
    <!--Stylesheet -->
    <link rel="stylesheet" href="../css/index.css">
    <title>Chat Application - Home</title>

</head>
    
    
<body class="container-fluid">
    
    
    <div class="header row">
        <div class="logo col-md-10 col-lg-11">
            Chat Application
        </div>
        <div class="col-md-2 col-lg-1">
            <a href="logout.php"><button type="button" class="btn btn-sm btn-default logout">Logout <span class="glyphicon glyphicon-off"></span></button></a> 
        </div> 
    </div>
    
    
    <div class="row header-2">
        <div class="col-2">
            <button type="button" class="btn btn-sm set-profile-pic">Set Profile Picture</button>
        </div>
        <div class="welcome-msg col-8">
            Welcome, <?php echo ($_SESSION['username']); ?> to the world of connectivity
        </div>
        <div class="col-2" style="margin-top: 5px;">
            <div class="progress">
                <div class="progress-bar" id="progress-bar" style="width:0%"></div>
            </div>
        </div>
    </div>
    
    
    <div class="row main-body">
        <div class="col-4 friends-list">
            <div class="check-friends">Check Friends</div>
            <div id="user-details" class="user-details"></div>
        </div>
        
        <div class="col-8">
            <div class="chat-box"></div>
        </div>
    </div>      
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<script>
    
    //Set Profile Picture
    $(document).on("click", ".set-profile-pic", function()
    {
        $('.chat-box').html("<div class='remove' style='float: right; cursor: pointer;'><span class='material-icons' style='margin: 10px;'>cancel</span></div><div class='main'> <div style='margin: 0px auto; width: 300px;'><div id='profile-pic'></div><label for='file' class='btn' style='background-color: #11887B; color: white;  margin: 20px auto; width: 300px;'>Change</label><input type='file' accept='image/*' name='file' id='file' style='display: none;'></div></div>");
       
                
        setInterval(function(){
           display_image(); 
        }, 1000);  
        
        
        function display_image()
        {
            $.ajax({
                url: "upload-profile-pic.php",
                method: "GET",
                success:function(data){
                            $('#profile-pic').html(data);
                        }
            });
        }
        
        $(document).on("change", "#file", function(){
            var property = document.getElementById("file").files[0];
            var img_name = property.name;
            var img_extension = img_name.split('.').pop().toLowerCase();
            
            var form_data = new FormData();
            form_data.append("file", property);
            
            $.ajax({
                url: "upload-profile-pic.php",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                                $('#profile-pic').html("<label class='text-success'>Image Uploading...</label>");
                            },   
                success:function(data){
                                $('#profile-pic').html(data);
                    
                        }
            });
        });
    });
    
    
    //For the cross icon
    $(document).on("click", ".remove", function(){
        $('.chat-box').html('');
    })
    
        
    //Function is used to get all user details 
    function fetch_user()
    {   
        var req = new XMLHttpRequest();
        req.open("get", "fetch-user.php", true);
        req.send();
    
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                document.getElementById("user-details").innerHTML = req.responseText;
            }
        };
    }
    
    
    //Function to update the last activity
    function update_last_activity()
    {
        var req = new XMLHttpRequest();
        req.open("get", "update-last-activity.php", true);
        req.send();
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
            }
        };
    }

    
    //Function to get the chat history
    function get_chat_history(to_userid)
    {
        var req = new XMLHttpRequest();
        req.open("post", "get-chat-history.php");
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("to_userid="+to_userid);
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                $("#chat-with-"+to_userid).html(req.responseText);
            }
        };
    }
    
    
    //Function used to insert chat into the database
    function insert_chat(to_userid, message, property)
    {
        var form_data = new FormData();
        form_data.append("to_userid", to_userid);
        form_data.append("message", message);
        form_data.append("share_file", property);
        
        var req = new XMLHttpRequest();
        req.open('POST', 'insert-chat.php', true);
        
        req.upload.addEventListener("progress", progressHandler, false);
        req.addEventListener("load", completeHandler, false);
        req.addEventListener("error", errorHandler, false);
        
        req.send(form_data);
      
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                $("div.emojionearea-editor").data("emojioneArea").setText('');
                document.getElementById("share_file").value = "";
            }
        };

        function progressHandler(event)
        {
            var percent = (event.loaded / event.total) * 100;
            percent = Math.round(percent);
             document.getElementById("progress-bar").style.width = percent+"%";
        }
        
        function completeHandler(event)
        {
            document.getElementById("progress-bar").style.width = "0%";
        }
        
        function errorHandler(event)
        {
            alert("Error occured while uploading");
        }
    }
    
    
    
    //Function for message notification
    function msg_notification()
    {
        if($(".chat-title").data('to_userid') != undefined)
        {
            var from_user_id = $(".chat-title").data('to_userid');
            var req = new XMLHttpRequest();
            req.open("post", "msg-notification.php");
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("from_user_id="+from_user_id);
        
            req.onreadystatechange  = function() 
            {
                if(req.readyState==4 && req.status == 200)
                {
                }
            };
        }
    }
    
    
    
    //calling fetch user() which is used to get all user details and online/offline status
    fetch_user();
    
    setInterval(function(){
        msg_notification();
    }, 1000);
    
    setInterval(function(){
        fetch_user();
        update_last_activity();
    }, 3000);
    
    
    //Function to update the chat history
    function update_chat_history(to_userid)
    {
        var last_index = -1;
        
        setInterval(function()
        {
            var req = new XMLHttpRequest();
            req.open("post", "update-chat-history.php");
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("to_userid="+to_userid);
        
            req.onreadystatechange  = function() 
            {
                if(req.readyState==4 && req.status == 200)
                {
                    if(req.responseText > last_index)
                    {
                        last_index = req.responseText;
                        get_chat_history(to_userid);
                    }
                }
            };
        }, 1000);
    }
    
    
    //This describes the what to be done when a start chat message is clicked
    $(document).on("click", ".start-chat", function()
    {
        var to_userid = $(this).data('touserid');
        var to_username = $(this).data('tousername');
        var profile_pic = $(this).data('profile_pic');
        
        $('.chat-box').html("<div class='chat-title'></div><div class='chat-body'></div><div class='message-form row'><div class='col-9'><textarea name='message' style='display: none;' id='message-box'></textarea></div><div class='col-1'><label for='share_file'><div class='share-button'><span class='material-icons'>share</span></div></label><input type='file' name='share_file' id='share_file' accept='image/*, .mp3, .mp4, .ogv' style='display: none;'></div><div class='col-2'><div class='send-button'><button type='submit' class='btn send-chat'><img src='https://img.icons8.com/small/32/9B9B9B/filled-sent.png'/></button></div></div></div>");
        
        get_text_area();

        $('.chat-title').attr("id", "to-userid-"+to_userid);
        $('.chat-title').data("to_userid", to_userid);
        $('.chat-body').attr("id", "chat-with-"+to_userid);
        $('.send-chat').data("to_userid", to_userid);
        $('#message-box').data("to_userid", to_userid);
        
        $('#to-userid-'+to_userid).html("<img src = '../profile-pic/"+profile_pic+"'height=50px width=50px style='border-radius: 100%'> "+to_username);
        
        update_chat_history(to_userid);
        
        setInterval(function(){
            get_chat_history(to_userid);
        }, 60000);
    });
    
    
    
    //This describes the what to be done when a send chat message is clicked
    $(document).on("click", ".send-chat", function()
    {
        if( document.getElementById('message-box').value == '' && document.getElementById("share_file").files.length == 0)
        {
            alert("Enter a message to send!");
        }
        else
        {
            var to_userid = $(this).data('to_userid');
            var message =  document.getElementById('message-box').value;
            var property = document.getElementById("share_file").files[0];
            
            insert_chat(to_userid, message, property);
        }
    });
    
        
    //Delete chat message
    $(document).on("click", ".delete-msg", function()
    {
        var id = $(this).attr("id");
        
        var to_user_id = $(this).data('to_user_id');
        
        var req = new XMLHttpRequest();
        req.open("post", "delete-msg.php");
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("chat_message_id="+id);
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                update_chat_history(to_user_id);
            }
        };    
    });
    
    
    //Check User Profile
    $(document).on("click", ".check-profile", function()
    {
        var id = $(this).data("user_id");
        
        var req = new XMLHttpRequest();
        req.open("post", "check-profile.php");
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("user_id="+id);
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                $('.chat-box').html(req.responseText);
            }
        }; 
    });
    
</script>


<!--Script for emojionarea-->
<script>
    
    function get_text_area()
    {
        $("#message-box").emojioneArea({  pickerPosition:"top",
                                           placeholder: "Write your message here"
                                       });
        
        var msg_box = $("#message-box").emojioneArea();
        
        msg_box[0].emojioneArea.on("focus", function(editor, event) 
        {
            if($("#message-box").data('to_userid') != undefined)
            {
                var to_userid = $("#message-box").data('to_userid');
                var is_typing = 1;
            
                var req = new XMLHttpRequest();
                req.open("post", "set-typing-status.php");
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("to_userid="+to_userid+"&is_typing="+is_typing);
            
                req.onreadystatechange  = function() 
                {
                    if(req.readyState==4 && req.status == 200)
                    {
                    }
                };
            }
        });
                
        
        msg_box[0].emojioneArea.on("blur", function(editor, event) 
        {
             
            if($("#message-box").data('to_userid') != undefined)
            {
                var to_userid = 0;
                var is_typing = 0;
            
                var req = new XMLHttpRequest();
                req.open("post", "set-typing-status.php");
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("to_userid="+to_userid+"&is_typing="+is_typing);
            
                req.onreadystatechange  = function() 
                {
                    if(req.readyState==4 && req.status == 200)
                    {
                    }
                };
            }                                           
        });
    }
</script>