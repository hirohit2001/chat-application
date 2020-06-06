<?php
    include('sign-up-user.php');
?>

<!doctype html>
<html lang="en">
<head>
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../css/sign-up.css">
<title>Create your account</title>
    
</head>
<body>
    <div class="sign-up-form col-sm-12 col-md-7 col-lg-4">
        <div class="header text-center">Sign Up Chat Application</div>
        <p style="color: red; text-align: center;">
            <?php echo($message); ?>
        </p>
        <form action="" method="post">
        <div class="row">
            <div class="form-group col-lg-12">
                <label for="user_name">Username</label>
                <input type="text" class="form-control" id="user_name" name="username" placeholder="Enter username" autocomplete="off" required>
            </div>
            <div class="form-group col-lg-12">
                <label for="user_password">Password</label>
                <input type="password" class="form-control" id="user_password" name="password" placeholder="Enter password" autocomplete="off" required>
            </div>
            <div class="form-group col-lg-12">
                <label for="user_email">Email Address</label>
                <input type="email" class="form-control" id="user_email" name="email" placeholder="Enter email" autocomplete="off" required>
            </div>
            <div class="form-group col-sm-6 col-md-6 col-lg-6">
                <label for="user_country">Country</label>
                <select class="form-control" name="country" required>
                    <option disabled="">Select your country</option>
                    <option>India</option>
                    <option>Pakistan</option>
                    <option>Sri Lanka</option>
                    <option>Nepal</option>
                    <option>Bangladesh</option>
                </select>
            </div>
            <div class="form-group col-sm-6 col-md-6 col-lg-6">
                <label for="user_gender">Gender</label>
                <select class="form-control" name="gender" required>
                    <option disabled="">Select your gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Others</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value=""> I accept the <a href="#">Terms of use</a> &amp; <a href="#">Privacy Policy</a>
                    </label>
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-success btn-block" name="sign-up">Submit</button>
        </form>
        <br>
        <div class="text-center small">Already have an account ? </div>
        <div class="text-center small"><a href="sign-in.php">Sign in</a></div>
    </div>
  </body>
</html>