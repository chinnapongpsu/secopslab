<?php
session_start();
    include_once('functions.php');
    $userdata = new DB_con();
    
    if(isset($_POST['login'])){
      $uname = $_POST['username'];
      $password =md5 ($_POST['password']);

      $result = $userdata->signin($uname,$password);
      $num = mysqli_fetch_array($result);

        if($num > 0){
          $_SESSION['id'] = $num['id'];
          $_SESSION['fname'] = $num['fullname'];
          echo "<script>alert('Login Successful!');</script>";
          echo "<script>window.location.href='welcome.php'</script>";
        }else {
          echo "<script>alert('Someting went wrong!');</script>";
          echo "<script>window.location.href='signin.php'</script>";
        }
    }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
    crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h1>Login Page</h1>
    <hr>
    <form method="post">
  <div class="mb-3">
    <label for="uname" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="uname" >
    <span id="usernameavailable"></span>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" >
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button>
  <a href="index.php" class="btn btn-primary">Go to Register</a>
    </form>
</div>

< src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" 
integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" 
crossorigin="anonymous"></>

< src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" 
integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" 
crossorigin="anonymous"></>



</body>
</html>