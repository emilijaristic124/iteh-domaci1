<?php
 require "dbBroker.php";
 require "user.php";

 session_start();

 if(isset($_GET['username']) && isset($_GET['password'])) {
     $uname=$_GET['username'];
     $password=$_GET['password'];

    $rs = User::logInUser($uname, $password, $connection);


      if($rs->num_rows==1) {
          echo "You have successfully logged in!";
          $_SESSION['user_id'] = $rs->fetch_assoc()['id'];
          header('Location: home.php');
          exit();
      } else {
      
          echo '<script type="text/javascript">alert("Try again :("); 
                                                window.location.href = "http://localhost/domaci/login.php";</script>';
          exit();
      }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login1.css">
    <link rel="shortcut icon"  type="image/x-icon" href="img/favicon1.ico" />
    <title>Game wishlist</title>

</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <form method="GET" action="#"> 
                <h1>Game wishlist</h1>
                <div class="container">
                    <input type="text" placeholder="username" name="username" class="login-input"  required>
                    <input type="password" placeholder="password" name="password" class="login-input" required>
                    <button type="submit" class="login-button" name="submit">Log in</button> 
                </div>

            </form>
        </div>
    </div>
</body>
</html>