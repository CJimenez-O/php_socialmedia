<?php

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

      if(empty($error_array)){
            $password = md5($password); // encrpyts password before sending to DB

            // generate username by concatenating first and lastname 
            $username = strtolower($fname . "_" .$lname);
            $checkusername_query = mysqli_query($con , "SELECT username FROM user WHERE username='$username'");

            //profile pic assignment 
            $profile_pic = 'assets/Profile_pics/Sample_User_Icon.png';

            // adding values to DB
            $query = mysqli_query($con, "INSERT INTO users VALUES ('0', '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',' )");

            array_push($error_array, "<span> You're all set! </span>");

            // clear session variables 
            $_SESSION['reg_fname'] = '';
            $_SESSION['reg_lname'] = '';
            $_SESSION['reg_email'] = '';
            $_SESSION['reg_email2'] = '';
      }
}

?>