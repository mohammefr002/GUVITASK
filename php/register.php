<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);


$mongo = new MongoDB\Client('mongodb://localhost:27017');

$db = $mongo->my_database;
$collection = $db->users;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $name = $_POST['name'];
	$email = $_POST['eamil'];
    $password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

    
    if ($redis->hExists('users', $name)) {
        echo 'name already exists';
        exit;
    }

   
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $email = uniqid();

    $user = [
        'name' => $name,
        'password' => $hashedPassword,
        'email' => $_POST['email'],
    ];
    $collection->insertOne($user);

    $redis->hSet('users', $name, json_encode([
        'email' => $email,
        'password' => $hashedPassword,
    ]));

    header('Location: login.php');
    exit;
}

?>