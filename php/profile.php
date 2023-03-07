<?php
session_start();
// check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: profile.php");
  exit();
}

// get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$contact = $_POST['contact'];

// validate the form data
if (empty($name) || empty($email) || empty($age) || empty($dob) || empty($contact)) {
  $_SESSION['error'] = "Please fill in all fields.";
  header("Location: update.php");
  exit();
}

// update the user profile in the database
$user_id = $_SESSION['user_id'];
$db_conn = mysqli_connect("localhost", "username", "password", "database_name");
if (!$db_conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE users SET name='$name', email='$email', age=$age, dob='$dob', contact='$contact' WHERE id=$user_id";
$result = mysqli_query($db_conn, $sql);
if (!$result) {
  $_SESSION['error'] = "Failed to update profile.";
  header("Location: update.php");
  exit();
}

// redirect to the profile page
header("Location: profile.php");
exit();
?>
