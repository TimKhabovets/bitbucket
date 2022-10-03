<?php

session_start();

include '../crud/crud.php';

$data_b = new Database();
$data_b->connect();

$login = $_POST['login'];
$password = $_POST['password'];

$error = [];

if ($login === '') {
    $error[] = 'login';
}

if ($password === '') {
    $error[] = 'password';
}

if (!empty($error)) {
    $response = [
        "status" => false,
        "message" => "check if the fields are correct",
    ];

    echo json_encode($response);

    die();
}

$password = md5($password);

$select = $data_b->select_login($login, $password);

if($select) {
     
    $_SESSION['name'] = $select->name;

    $response = [
        "status" => true
    ];
    
    echo json_encode($response);

} else {

    $response = [
        "status" => false,
        "message" => 'incorrect email or password!'
    ];

    echo json_encode($response);
}
?>
