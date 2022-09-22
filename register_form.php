<?php

session_start();

include 'crud\crud.php';

if(isset($_POST['submit'])){

   $login = $_POST["login"];
   $name = $_POST["name"];
   $pass = $_POST['password'];
   $cpass = $_POST['conf_password'];
   $email = $_POST["email"];
   $user_type = $_POST['user_type'];

   $pass = md5($pass);
   $cpass = md5($cpass);

   $data_b = new Database();
   $data_b->connect();
   $select = $data_b->select_register($login, $email);

   if (strlen($login) < 6) {
      $error[] = 'login must contain at least 6 characters';
   }
   elseif (stripos($login, " ") !== false) {
      $error[] = 'in the login not be present spaces';
   }
   elseif (stripos($pass, " ") !== false) {
      $error[] = 'in the password not be present spaces';
   }
   elseif (preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', $email)) {
      $error[] = 'email is not valid';
   }
   elseif ((strlen($pass) < 6 || !preg_match('/\d/', $pass)) || !preg_match('/[a-zA-Z]/', $pass)) {
      $error[] = 'the password must contain a letter and a number and be at least 6 characters long';
   }
   elseif (!ctype_alpha($name) || strlen($name) < 2) {
      $error[] = 'name must be at least 2 characters long and contain only letters';
   }
   elseif ($select == 'login') {
      $error[] = 'this login is already taken';
   }
   elseif ($select == 'email') {
      $error[] = 'this email is already taken';
   } else {
      if ($pass !== $cpass){
         $error[] = 'password not matched!';
      } else {
         $data_b->insert($login, $pass, $name, $email, $user_type);
         header('location:login_form.php');
      }
   }
   
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="login" name="login" required placeholder="enter your login">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="conf_password" required placeholder="confirm your password">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="text" name="name" required placeholder="enter your name">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

<script src="js/main.js"></script>

</body>
</html>