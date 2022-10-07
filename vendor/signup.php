<?php

session_start();

include '../crud/crud.php';

$data_b = new Database();
$data_b->connect();

$login = $_POST['login'];
$name = $_POST['name'];
$password = $_POST['password'];
$conf_password = $_POST['conf_password'];
$email = $_POST['email'];

$error = [];

if (strlen($login) < 6) {
   $error[] = 'login';
}

if(stripos($login, " ") !== false) {
   $error[] = 'login';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   $error[] = 'email';
}

if ((strlen($password) < 6 || !preg_match('/\d/', $password)) || !preg_match('/[a-zA-Z]/', $password)) {
   $error[] = 'password';
}

if(stripos($password, " ") !== false) {
   $error[] = 'login';
}

if (!ctype_alpha($name) || strlen($name) < 2) {
   $error[] = 'name';
}

if (!empty($error)) {
   $response = [
       "status" => false,
       "type" => 1,
       "message" => "check if the fields are correct",
       "fields" => $error
   ];

   echo json_encode($response);

   die();
}

$password = md5($password);
$conf_password = md5($conf_password);

$select = $data_b->select_register($login, $email);
   
   if ($select == 'login') {
      $error[] = 'login';

      $response = [
         "status" => false,
         "type" => 2,
         "message" => "this login is already taken",
         "fields" => $error
     ];
  
     echo json_encode($response);
  
     die();

   }
   elseif ($select == 'email') {
      $error[] = 'email';

      $response = [
         "status" => false,
         "type" => 3,
         "message" => "this email is already taken",
         "fields" => $error
     ];
  
     echo json_encode($response);
  
     die();

   } else {
      if ($password !== $conf_password){
         $error[] = 'conf_password';
         $error[] = 'password';

         $response = [
            "status" => false,
            "type" => 4,
            "message" => "password not matched!",
            "fields" => $error
        ];
     
        echo json_encode($response);
     
        die();

      } else {
         $data_b->insert($login, $password, $name, $email);
         $response = [
            "status" => true,
            "message" => "register completed successfully!",
        ];
        echo json_encode($response);
      }
   }

?>
