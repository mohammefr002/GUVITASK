<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$mongo = new MongoDB\Client('mongodb://localhost:27017');


$db = $mongo->my_database;
$collection = $db->users;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$redis->hExists('users', $email)) {
        echo 'Invalid email or password';
        exit;
    }

    $userData = $redis->hGetAll('users', $email);

    if (!password_verify($password, $userData['password'])) {
        echo 'Invalid email or password';
        exit;
    }

    $user = $collection->findOne(['_id' => $userData['id']]);

    session_start();
    $_SESSION['user'] = $user;


    header('Location: dashboard.php');
    exit;
}

?>