<?php

$client = new MongoClient();
$redis = new Redis();

if (!$client->connect() || !$redis->connect()) {
    exit('Failed to connect to MongoDB or Redis.');
}

if (isset($_POST['save'])) {
    $document = array(
        'name' => $_POST['name'],
        'email'=> $_POST['email'],
        'dob' => $_POST['dob'],
        'age' => $_POST['age'],
        'contact' => $_POST['contact'],
    );
    $redis->set($_POST['name'], json_encode($document));
    $client->selectDB('users')->selectCollection('profiles')->insert($document);
    exit('Data saved successfully!');
}

$name = $_GET['name'];
$document = $redis->get($name);
if (!$document) {
    $document = $client->selectDB('users')->selectCollection('profiles')->findOne(array('name' => $name));
    $redis->set($name, json_encode($document));
}

?>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $document['name'] ?>" /><br />
    Email: <input type="text" name="email" value="<?php echo $document['email'] ?>" /><br />
    Age: <input type="text" name="age" value="<?php echo $document['age'] ?>" /><br />
    dob: <input type="text" name="dob" value="<?php echo $document['dob'] ?>" /><br />
    contact: <input type="text" name="contact" value="<?php echo $document['contact'] ?>" /><br />
    <input type="submit" name="save" value="Save" />
</form>
