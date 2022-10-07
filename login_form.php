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
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script src="js/jquery.js"></script>

   <script src="js/no-form.js"></script>

</head>
<body>


   
<div class="form-container">

   <form>
      <div id="noJS"> please enable JavaScript</div>

      <h3>login now</h3>

      <span class="error-msg none"></span>

      <input type="login" name="login" required placeholder="enter your login">
      <input type="password" name="password" required placeholder="enter your password">
      <button type="submit" id="site" class="login-btn">login now</button>
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

<script src="js/ajax.js"></script>

</body>
</html>