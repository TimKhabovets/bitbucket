<?php

session_start();

if(isset($_SESSION['name'])){
   header('location:page.php');
}

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

   <form >
      <h3>register now</h3>

      <span class="error-msg none"></span>

      <span class="error-msg login none"></span>
      <input type="login" name="login" required placeholder="enter your login">
      <span class="error-msg password none"></span>
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="conf_password" required placeholder="confirm your password">
      <span class="error-msg email none"></span>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="text" name="name" required placeholder="enter your name">
      <button type="submit" class="register-btn">register now</button>
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

<script src="js/jquery.js"></script>
<script src="js/ajax.js"></script>

</body>
</html>