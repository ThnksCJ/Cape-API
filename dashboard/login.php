<?php
require_once ('config.php');

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/signin.css">
    <title>Sign in</title>
    <link rel="shortcut icon" href="../assets/NABIA.png" />
</head>
<body>
<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 style="color:black" class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input name="Username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> <p style="color:black" class="form-signin-heading">Remember me</p>
            </label>
        </div>
        <button name="Submit" value="Login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <?php

        /* Check if login form has been submitted */
        if(isset($_POST['Submit'])){

            // Rudimentary hash check
            $result = password_verify($_POST['Password'], $Password);

            /* Check if form's username and password matches */
            if( ($_POST['Username'] == $Username) && ($result === true) ) {

                /* Success: Set session variables and redirect to protected page */
                $_SESSION['Username'] = $Username;

                $_SESSION['Active'] = true;
                $log  = "[".date("F j, Y, g:i a")."] User Logged Into Admin Panel: | Username: ".$Username.PHP_EOL;
                file_put_contents('../logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
                header("location:./");
                exit;

            } else {
                ?>
                <!-- Show an error alert -->
                &nbsp;
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong> Incorrect information.
                </div>
                <?php
            }
        }
        ?>

    </form>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
