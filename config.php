<?php 
ob_start();
// allows ability to store vairables 
session_start();

$timezone = date_default_timezone_set("America/Los_Angeles");

$con = mysqli_connect("localhost", "root", "", "Ticketsys");

if (mysqli_connect_errno()) {
      echo "Failed to connect" . mysqli_connect_errno();
}
?>