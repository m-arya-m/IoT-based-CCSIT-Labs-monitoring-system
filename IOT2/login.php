<?php
session_start();
include_once("DbHandler.php");
$db = new DbHandler(); // Instantiate DbHandler
$db->dbConnect(); // Connect to the database

if (isset($_POST['loginFacultyMember']) || isset($_POST['loginITD'])) {
  // Common login procedure
  function login($db, $user, $pass) {
      $result = $db->login($user, $pass);
      if ($result && mysqli_num_rows($result) == 1) {
          $auth_code = bin2hex(random_bytes(32));
          $_SESSION["user"] = $user;
          $res = $db->updateAccess($auth_code, $user);
          if ($res) {
              return true; }
      }
      return false;}
}
?>

<html>
<head>
  <title>IoT-based CCSIT Labs monitoring system</title>
  <link rel="website icon" href="logo.png">
  <link href="style.css" rel="stylesheet">
</head>
<body>
    <header>
      <img src="logo.png" alt="logo" class="left">
      <h1>IoT-based CCSIT Labs <br>monitoring system</h1>
      <img src="kfu.png" alt="university" class="right">
    </header>
<section class="loginBtn">
<h3 id="para1">Login to Start</h3>
<button  id="loginF" type="button">Faculty member</button>
<button  id="loginIT" type="button">IT department </button>
</section>

   <form id="FMForm" action="login.php" method="POST" style="display: none;">
   <input type="text" placeholder="Username" class="login" name="username" value="" required><br>
   <input type="password" placeholder="Password" class="login" name="password" value=""required><br>
   <button id="FMBtn" type="submit" name="loginFacultyMember">Login</button>
 </form>

 <form id="ITForm" action="login.php" method="POST" style="display: none;">
   <input type="text" placeholder="Username" class="login" name="username" value="" required><br>
   <input type="password" placeholder="Password" class="login" name="password" value=""required><br>
   <input type="number" placeholder="Id" class="login" name="id" value=""required><br>
   <button id="ITBtn" type="submit" name="loginITD">Login</button>
 </form>
   
<?php
if (isset($_POST['loginITD'])) {
  $user = $_POST["username"];
  $pass = $_POST["password"];
  $id = $_POST["id"];
  // Check if ID is between 1 and 15
  if ($id >= 1 && $id <= 15) {
      if (login($db, $user, $pass)) {
          header("Location:labsList.php");
          exit;
      } else {
          echo '<p style="color:red; margin-left: 400px; font-size: 45px;">Incorrect IT username/password or ID!</p>' ; } 
  }
}
if (isset($_POST['loginFacultyMember'])) {
  $user = $_POST["username"];
  $pass = $_POST["password"];

  if (login($db, $user, $pass)) {
      header("Location:labsListF.php");
      exit;
  } else {
      echo'<p style="color:red; margin-left: 400px; font-size: 45px;">Incorrect faculty username/password!</p>' ;
  }
}
?>

  <script>  
  // login FM Button and Form
  document.getElementById('loginF').addEventListener('click', function() {
    document.getElementById('FMForm').style.display = 'block';
    document.getElementById('ITForm').style.display = 'none';

  });
    // login ITD Button and Form
    document.getElementById('loginIT').addEventListener('click', function() {
    document.getElementById('ITForm').style.display = 'block';
    document.getElementById('FMForm').style.display = 'none';

  });
  
  </script>
</body>

</html>