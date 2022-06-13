<?php

// allows ability to store vairables 
session_start();

$con = mysqli_connect("localhost", "root", "", "Ticketsys");

if (mysqli_connect_errno()) {
      echo "Failed to connect" . mysqli_connect_errno();
}

//declaring Variables to prevent errors
$fname = '';
$lname = '';
$email = '';
$email2 = '';
$password = '';
$password2 = '';
$date = '';
$error_array = array();

// if register button is pressed and methos is POST, grab values from form
if (isset($_POST['reg_button'])) {
      // register form button
      $fname = strip_tags($_POST['reg_fname']);  //remove HTML tags to prevent malicious code
      $fname = str_replace(" ", '', $fname);   //remove spaces from name
      $fname = ucfirst(strtolower($fname));    // uppercase first letter
      $_SESSION['reg_fname'] = $fname; //stores value into session

      $lname = strip_tags($_POST['reg_lname']);
      $lname = str_replace(" ", '', $lname);
      $lname = ucfirst(strtolower($lname));
      $_SESSION['reg_lname'] = $lname;

      $email = strip_tags($_POST['reg_email']);
      $email = str_replace(" ", '', $email);
      $_SESSION['reg_email'] = $email;

      $email2 = strip_tags($_POST['reg_email2']);
      $email2 = str_replace(" ", '', $email2);
      $_SESSION['reg_email2'] = $email2;

      $password = strip_tags($_POST['reg_password']);

      $password2 = strip_tags($_POST['reg_password2']);

      $date = date("Y-m-d");

      if ($email == $email2) {
            //check if email is in correct format
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $email = filter_var($email, FILTER_VALIDATE_EMAIL);

                  // check if email already exists
                  $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                  //count number of rows returned
                  $num_rows = mysqli_num_rows($e_check);

                  if ($num_rows > 0) {
                        array_push($error_array, "Email already in use <br>");  //pushes error into array
                  }
            } else {
                  array_push($error_array, "Email in invalid format <br>");
            }
      } else {
            array_push($error_array, "Emails do not match <br>");
      }

      if (strlen($fname) > 25 || strlen($fname) < 2) {
            array_push($error_array, "Your first name must be between 2 - 25 charaters<br>");
      }

      if (strlen($lname) > 25 || strlen($lname) < 2) {
            array_push($error_array, "Your last name must be between 2 - 25 charaters<br>");
      }

      if ($password != $password2) {
            array_push($error_array, "Your password do not match <br>");
      }

      if (strlen($password) > 30 || strlen($password < 5)) {
            array_push($error_array, "Your password must be between 5 - 3 characters <br>");
      }
}
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


      </form>
</body>

</html>