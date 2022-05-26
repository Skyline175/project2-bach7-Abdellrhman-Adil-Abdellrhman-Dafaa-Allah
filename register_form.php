<?php

@include 'config.php';
if(isset($_POST['submit'])){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['passeord']); 
  $cpass = md5($_POST['cpassword']); 
  $user_type = md5($_POST['user_type']);


  $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

  $result = mysqli_connect_query($conn, $select);

if(mysqli_num_rows($result) > 0){
    $error[] = 'user already exist!';

}else{
     
    if($pass != $cpass){
        $error[] = 'password not matched!';
    }else{
        $insert = "INSERT INTO user_form(name,email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
        mysql_query($conn, $insert);
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
    <!--css file-->
    <link rel="stylesheet" href="css/style.css">
      <!--render-->
      <link rel="stylesheet" href="css/normalize.css"/>
      <!-- font from websie -->
      <link rel="stylesheet" href="css/all.min.css"/>
      <!-- fonts-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,200;1,300&display=swap" 
        rel="stylesheet"/>
  
</head>
<body>
    
<div class="form-container">

<form action="" method="post">
    <h3>Register NOW</h3>
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';

        };
    };
    ?>

    <input type="text" name="name" required placeholder="Enter your name">
    <input type="email" name="email" required placeholder="Enter your email">
    <input type="password" name="password" required placeholder="Enter your password">
    <input type="password" name="cpassword" required placeholder="Confirm your name">
    <select name="user_type">
        <option value="User">User</option>
        <option value="Admin">Admin</option>
    </select>
    <input type="submit" name="submit" value="submit now " class="form-btn">
    <p>already have an account? <a href="login_form.php">login now</a> </p>
</form>

</div>

</body>
</html>