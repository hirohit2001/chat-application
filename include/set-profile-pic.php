<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <title>Chat Application - Set profile picture</title>
    <link rel="stylesheet" href="../css/set-profile-pic.css">
</head>
    
<body class="container-fluid">
    
<a href="index.php" style="color: black"><span class="material-icons" style="margin: 10px;">cancel</span></a>
    
 <div class="main">  
    <div style="margin: 0px auto; width: 300px;">
        <div id="profile-pic"></div>
        
        <label for="file" class='btn' style="background-color: #11887B; color: white;  margin: 20px auto; width: 300px;">Change</label>
        <input type="file" accept="image/*" name="file" id="file" style="display: none;">
    </div>
</div>
 
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        
        setInterval(function(){
           display_image(); 
        }, 100);  
        
        
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
</script>