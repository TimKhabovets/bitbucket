<?php

session_start();

include 'crud\crud.php';

if(isset($_POST['submit'])){
   $data_b = new Database();
   $data_b->connect();
   $login = $_POST["login"];
   $password = md5($_POST["password"]);
   $select = $data_b->select_login($login, $password);

   if($select) {
      if($select->user_type == 'admin'){

         $_SESSION['admin_name'] = $select->name;
         header('location:admin_page.php');

      }elseif($select->user_type == 'user'){

         $_SESSION['user_name'] = $select->name;
         header('location:user_page.php');

      }
   } else {
      $error[] = 'incorrect email or password!';
   }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="login" name="login" required placeholder="enter your login">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>