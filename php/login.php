<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if email and password are set
  if (isset($_POST["name"]) && isset($_POST["password"])) {
    $email = $_POST["name"];
    $password = $_POST["password"];
	header("Location:login.php");

    // Validate email and password
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 8) {
      // Authenticate user (you can replace this with your own authentication code)
      if ($email === "user@example.com" && $password === "password123") {
        // Start session and store user data
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["loggedIn"] = true;

        // Redirect to home page or dashboard
        header("Location: home.php");
        exit();
      } else {
        // Invalid credentials, show error message
        $errorMessage = "Invalid email or password";
      }
    } else {
      // Invalid email or password format, show error message
      $errorMessage = "Invalid email or password format";
    }
  } else {
    // Email or password not set, show error message
    $errorMessage = "Email and password are required";
  }
}
?>

