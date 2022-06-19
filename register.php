<?php

require 'config.php';
require 'formHandlers/register_handler.php';
require 'formHandlers/login_handler.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Xpress Ticket System</title>
</head>

<body>

      <form action='register.php' method="POST">
            <input type="email" name="log_email" placeholder="Email Address">
            <input type="password" name="log_password" placeholder="Password">
            <br>
            <input type="submit" name='login_button' value="Login">

      </form>



      <form action='register.php' method='POST'>
            <?php if (in_array("Your first name must be between 2 - 25 charaters<br>", $error_array)) {
                  echo "Your first name must be between 2 - 25 charaters<br>";
            }
            ?>
            <input type='text' name='reg_fname' placeholder='First Name' value="
            <?php
            if (isset($_SESSION['reg_fname'])) {
                  echo $_SESSION['reg_fname'];
            }
            ?>" required>
            <br>

            <?php if (in_array("Your last name must be between 2 - 25 charaters<br>", $error_array)) {
                  echo "Your last name must be between 2 - 25 charaters<br>";
            }
            ?>
            <input type='text' name='reg_lname' placeholder='Last Name' value="
            <?php
            if (isset($_SESSION['reg_lname'])) {
                  echo $_SESSION['reg_lname'];
            }
            ?>" required>
            <br>


            <?php if (in_array("Emails do not match <br>", $error_array)) {
                  echo "Emails do not match <br>";
            } else if (in_array("Email in invalid format <br>", $error_array)) {
                  echo "Email in invalid format <br>";
            } else if (in_array("Emails do not match <br>", $error_array)) {
                  echo "Emails do not match <br>";
            } ?>

            <input type='email' name='reg_email' placeholder='Email' value="
            <?php
            if (isset($_SESSION['reg_email'])) {
                  echo $_SESSION['reg_email'];
            }
            ?>" required>
            <br>
            <input type='email' name='reg_email2' placeholder='Confirm Email' value="
            <?php
            if (isset($_SESSION['reg_email2'])) {
                  echo $_SESSION['reg_email2'];
            }
            ?>" required>
            <br>

            <?php if (in_array("Your password do not match <br>", $error_array)) {
                  echo "Your password do not match <br>";
            } else if (in_array("Your password must be between 5 - 3 characters <br>", $error_array)) {
                  echo "Your password must be between 5 - 3 characters <br>";
            }   ?>


            <input type='password' name='reg_password' placeholder='Password' required>
            <br>
            <input type='password' name='reg_password2' placeholder='Confirm Password' required>
            <br>
            <input type="submit" name='reg_button' value="Register">
            <br>

            <?php
                  if(in_array("<span> You're all set! </span>", $error_array)){
                        echo "<span> You're all set! </span>";
                  }  
            ?>



      </form>
</body>

</html>