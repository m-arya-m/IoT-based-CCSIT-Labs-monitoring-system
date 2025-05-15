<?php
session_start();
include_once('DbHandler.php');
$db = new DbHandler();
$db->dbConnect();

if(isset($_POST["login"])){

  $user = $_POST['username'];
  $pass = md5($_POST['password']);
  $result = $db->login($user, $pass);
  if(mysqli_num_rows($result)==1){

   $auth_code = session_id();
   $_SESSION["user"] = $user;
   $res= $db->updateAccess($auth_code, $user);
if($res){
        header("Location: pets.php");
        exit();
      }
    }else{ 
      $error=1;
  }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>CURD: PETS</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
   </head>
   <form method="post" action="login.php">
      <h1>CURD: PETS - LOGIN</h1>
      <div class="input-group">
         <label> Username</label>
         <input type="text" name="username" value="">
        </div>
         <div class="input-group">
          <label> Password</label>
          <input type="password" name="password" value="">
        </div>
        <div class="input-group">
         <button class="btn" type="submit" name="login">Login</button>
        </div>
</form>
</body>
</html>