<?php 
      $con = mysqli_connect("localhost", "root", "", "Ticketsys");

      if(mysqli_connect_errno()){
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
      $error_array = '';

      // if register button is pressed and methos is POST, grab values from form
      if(isset($_POST['reg_button'])){
            // register form button
            $fname = strip_tags($_POST['reg_fname']);  //remove HTML tags to prevent malicious code
            $fname = str_replace(" ", '', $fname);   //remove spaces from name
            $fname = ucfirst(strtolower($fname));    // uppercase first letter

            $lname = strip_tags($_POST['reg_lname']);  //remove HTML tags to prevent malicious code
            $lname = str_replace(" ", '', $lname);   //remove spaces from name
            $lname = ucfirst(strtolower($lname));    // uppercase first letter

            $email = strip_tags($_POST['reg_email']);  //remove HTML tags to prevent malicious code
            $email = str_replace(" ", '', $email);   //remove spaces from name
            $email = ucfirst(strtolower($email));    // uppercase first letter
            
            $email2 = strip_tags($_POST['reg_email2']);  //remove HTML tags to prevent malicious code
            $email2 = str_replace(" ", '', $email2);   //remove spaces from name
            $email2 = ucfirst(strtolower($email2));    // uppercase first letter

            $password = strip_tags($_POST['reg_password']);  //remove HTML tags to prevent malicious code

            $password2 = strip_tags($_POST['reg_password2']);  //remove HTML tags to prevent malicious code

            $date = date("Y-m-d");

            if($email == $email2){
                  //check if email is in correct format
                  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                        
                        // check if email already exists

                  }else{
                        echo 'invalid format';
                  }
            }else{
                  echo 'Emails do not match';
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
            <input type='text' name='reg_fname' placeholder='First Name' required >
            <br>
            <input type='text' name='reg_lname' placeholder='Last Name' required >
            <br>
            <input type='email' name='reg_email' placeholder='Email' required >
            <br>
            <input type='email' name='reg_email2' placeholder='Confirm Email' required >
            <br>
            <input type='password' name='reg_password' placeholder='Password' required >
            <br>
            <input type='password' name='reg_password2' placeholder='Confirm Password' required >
            <br>
            <input type="submit" name='reg_button' value="Register">


      </form>
</body>
</html>