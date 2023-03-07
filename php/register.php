<?php

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    header("Location: register.php");
{

	// Get the form data
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Validate the form data
	if (empty($name) || empty($email) || empty($password)) {
		echo 'All fields are required!';
		exit();
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Invalid email format!';
		exit();
	}

	// Connect to the MySQL database
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "myDB";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Check if the email is already registered
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo 'Email already registered!';
		exit();
	}

	// Insert the form data into the MySQL database
	$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

	if ($conn->query($sql) === TRUE) {
		echo 'Signup successful!';
	} else {
		echo 'Error: ' . $sql . '<br>' . $conn->error;
	}

	$conn->close();
}

?>
