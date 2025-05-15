<?php
session_start();
// Check if the user is logged in
if(!isset($_SESSION["user"])) {
  header("Location: login.php"); // Redirect to the login page if not logged in
  exit;
}
include_once("DbHandler.php");
$db=new DbHandler();
$db->dbConnect();

if (isset($_POST['submit'])) {

  $lab_no = $_POST['lab_number'];
  $lab_type = $_POST['type'];
  $number_of_devices = $_POST['devices_count'];
 // $devices_info = $_POST['devices_info'];
$insertSuccess = $db->insertLab($lab_no,$lab_type, $number_of_devices);
}
?>

<html>
<head>

  <title>IoT-based CCSIT Labs monitoring system</title>
  <link rel="website icon" href="logo.png">
  <link href="style.css" rel="stylesheet">
</head>

<body>
    <header id="head">
      <img src="logo.png" alt="logo" class="left">
      <h1>IoT-based CCSIT Labs <br>monitoring system</h1>
      <img src="kfu.png" alt="university" class="right">
     </header>   
     <nav class="nav">
      <a href="addLab.php">Add lab</a>
      <a href="devices.php">Devices</a>
      <a href="labsList.php">Labs list</a>
      <a href="logout.php">Logout</a>
      <p style="color:white; margin-left: 200px; font-size: 50px; font-style: oblique;">Hello, <?php echo $_SESSION["user"]; ?>!</p>
    </nav>
    

   <main>
    <h2>Add New Lab</h2>   
    <p style="color: red;">*</p>
    <p>Please full the lab information</p>       
    <?php 

if(isset($insertSuccess)){
  if($insertSuccess)
  echo '<p style="color:green; margin-left: 250px; font-size: 40px;" class="success-message">Inserted!</p>';
}
?>
    <form class="addLab" action="addLab.php" method="POST">

        <input type="number" placeholder="Lab No."  name="lab_number"required><br>
        <input list="labtype" placeholder="Lab type" name="type"required>

        <datalist id="labtype">
            <option value="Programming lab" >
            <option value="Database and Big Data Analysis Laboratory" >
            <option value="Operating Systems Laboratory" >
            <option value="Computer engineering laboratory" >
            <option value="Networks and Communications Laboratory" >
        </datalist>
<br>
        <input type="number" placeholder="Number of devices"  name="devices_count"required><br>
       <textarea name="devices_info" id="devices_info" cols="20" rows="3" placeholder="Devices information"></textarea><br>
    <button type="submit" name="submit">Done</button>  
</form>

   </main>


  <script src="js/script.js"></script>
</body>
</html>