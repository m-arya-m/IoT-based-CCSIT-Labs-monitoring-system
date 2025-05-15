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

if (isset($_POST['add'])) {
$name=$_POST['name'];
$device_number= $_POST['device_number'];
$operating_system= $_POST['operating_system'];
$lab_number = $_POST['lab_number'];
$components = $_POST['components'];
$inserted = $db->insertDevice($name, $device_number, $operating_system, $lab_number, $components);
}

if(isset($_GET['delete'])){
  $device_number=$_GET['device_number'];
  $lab_number=$_GET['lab_number'];
	$deleted=$db->deleteDevice($device_number, $lab_number);
	
}

if(isset($_POST['update'])){
$device_number= $_POST['device_number'];
$name=$_POST['name'];
$operating_system= $_POST['operating_system'];
$lab_number = $_POST['lab_number'];
$components = $_POST['components'];

	$updated=$db->updateDevice($device_number, $name, $operating_system, $lab_number, $components);
}

$searchResult = [];
if(isset($_GET['search'])){
    $device_number = $_GET['device_number'];
    $search = $db->searchForDevice($device_number);
    if($search->num_rows > 0){
        while($row = $search->fetch_assoc()) {
            $searchResult[] = $row;
        }
    } else {
        $searchResult = false;
    }
}
?>



<!DOCTYPE html>
<html>

<head>
  
<style>
    .searchTable {
      width: 100%;
      border-collapse: collapse;
      margin: 25px 0;
      font-size: 20px;
      box-shadow: 0 0 30px rgba(0,0,0,0.15);
    }

    .searchTable thead tr {
      background-color: #ffe4ca;
      color: #ffffff;
      text-align: center;
    }

    .searchTable th, .searchTable td {
      padding: 12px 15px;
    }

    .searchTable tbody tr {
      border-bottom: 1px solid black;
    }

    .searchTable tbody tr:nth-of-type(even) {
      background-color: #ffe4ca;
      text-align: center;
    }
  </style>

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
     <h2>Devices</h2>
  <p style="color: red;">*</p>
 <p>Please choose one and full the device information</p> 


 <section class="devices">
 <button id="addDeviceBtn" type="submit">Add Device</button>
 <button id="deleteDeviceBtn" type="submit">Delete Device</button>
 <button id="updateDeviceBtn" type="submit">Update Device</button>
 <button id="searchForDeviceBtn" type="submit">Search for device</button>
  </section>
 
<form id="addDeviceForm" action="devices.php" method="POST" style="display: none;">
<input type="text" placeholder="Name of Device"  name="name" required><br>
<input type="text" placeholder="Device No." name="device_number" required><br>
<input type="text" placeholder="Operating System" name="operating_system" required><br>
<input type="number" placeholder="Lab No." name="lab_number" required><br>
<input type="text" placeholder="Components " name="components" required><br>
<button id="addDeviceBtn" type="submit" name="add">Add</button>
</form>  
 
 
 <form id="deleteDeviceForm" action="devices.php" method="GET" style="display: none;">
    <input type="text" placeholder="Device No." name="device_number" required><br>
    <input type="number" placeholder="Lab No." name="lab_number" required><br>
    <button type="submit" name="delete">Delete</button>
  </form>

<form id="updateDeviceForm" action="devices.php" method="POST" style="display: none;">
<input type="text" placeholder="Device No." name="device_number" required><br>
<input type="text" placeholder="Name of Device"  name="name" required><br>
<input type="text" placeholder="Operating System" name="operating_system" required><br>
<input type="number" placeholder="Lab No." name="lab_number" required><br>
<input type="text" placeholder="Components " name="components" required><br>
<button id="updateDeviceBtn" type="submit" name="update">Update</button>
</form> 

<form id="searchForm" action="devices.php" method="GET" style="display: none;">
    <input type="text" placeholder="Device No." name="device_number" required><br>
    <button type="submit" name="search">Search</button>
  </form>
 <?php 

if(isset($inserted)){
  if($inserted)
  echo '<p style="color:green; margin-left: 650px; font-size: 50px;">Inserted!</p>';
}
if(isset($deleted)){
  if($deleted)
  echo '<p style="color:red; margin-left: 650px; font-size: 50px;">Deleted!</p>' ;
} 
if(isset($updated)){
if($updated)
  echo '<p style="color:blue; margin-left: 650px; font-size: 50px;">Updated!</p>' ;
}

if(isset($searchResult)){
  if($searchResult){
      // Display search results in a table
      echo '<table class="searchTable" border="3px" >';
      echo '<tr class="thead">';
      echo '<th>Name of device</th>';
      echo '<th>Device number</th>';
      echo '<th>Operating system</th>';
      echo '<th>Lab number</th>';
      echo '<th>Device components</th>';
      echo '</tr>';
      foreach($searchResult as $row){
          echo '<tr>';
          echo '<td>'.htmlspecialchars($row['name']).'</td>';
          echo '<td>'.htmlspecialchars($row['device_number']).'</td>';
          echo '<td>'.htmlspecialchars($row['operating_system']).'</td>';
          echo '<td>'.htmlspecialchars($row['lab_number']).'</td>';
          echo '<td>'.htmlspecialchars($row['components']).'</td>';
          echo '</tr>';
      }
      echo '</table>';
  } else {
      echo $searchResult === false ? '<p style="color:red; margin-left: 450px; font-size: 45px;">No results found, please try again.</p>' : '';
  }
}
?>

  </main>
 
  <script>
document.addEventListener("DOMContentLoaded", function(event) {
  // Add Device Button and Form
  document.getElementById('addDeviceBtn').addEventListener('click', function() {
    document.getElementById('addDeviceForm').style.display = 'block';
    document.getElementById('deleteDeviceForm').style.display = 'none';
    document.getElementById('updateDeviceForm').style.display = 'none';
    document.getElementById('searchForm').style.display = 'none';
  });

  // Delete Device Button and Form
  document.getElementById('deleteDeviceBtn').addEventListener('click', function() {
    document.getElementById('deleteDeviceForm').style.display = 'block';
    document.getElementById('addDeviceForm').style.display = 'none';
    document.getElementById('updateDeviceForm').style.display = 'none';
    document.getElementById('searchForm').style.display = 'none';
  });

  // Update Device Button and Form
  document.getElementById('updateDeviceBtn').addEventListener('click', function() {
    document.getElementById('updateDeviceForm').style.display = 'block';
    document.getElementById('addDeviceForm').style.display = 'none';
    document.getElementById('deleteDeviceForm').style.display = 'none';
    document.getElementById('searchForm').style.display = 'none';
  });

  // Search for device button and form
  document.getElementById('searchForDeviceBtn').addEventListener('click', function() {
    document.getElementById('searchForm').style.display = 'block';
    document.getElementById('addDeviceForm').style.display = 'none';
    document.getElementById('deleteDeviceForm').style.display = 'none';
    document.getElementById('updateDeviceForm').style.display = 'none';
  });

});
</script>

</body>

</html>