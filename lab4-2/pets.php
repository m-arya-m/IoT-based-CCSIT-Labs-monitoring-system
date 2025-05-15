<?php
session_start();
include_once('DbHandler.php');
$db = new DbHandler();
$db -> dbConnect();

if(isset($_POST['save'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];

  $result = $db->insert($id,$name);}
if(isset($_GET['del'])){
  $id=$_GET['del'];

  $delete_msg = $db->delete($id);

  if($delete_msg)
  header('Location: pets.php?error=1');}
if (isset($_SESSION['user'])){
 $username=$_SESSION['user'];
 $res = $db->access($username);

  if (mysqli_num_rows($res)==1){
    $row= mysqli_fetch_assoc($res);
    $auth_cod=$row['accesscode'];
    
    if($auth_code != $_COOKIE['PHPSESSID']){
      header("Location: login.php");
      exit();}}
}else{
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CURD: PETS</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
   </head>
<body>
    <form method="post" action="">
      <h1>CURD: PETS</h1>
      <?php
      if(isset($result)){
        if($result)
        echo "inserted!";
      else
      echo "Failed";
      }
      ?>
        <div class="input-group">
         <label> Pet ID</label>
         <input type="text" name="id" value="">
        </div>
         <div class="input-group">
          <label> Pet Name</label>
          <input type="text" name="name" value="">
        </div>
        <div class="input-group">
         <button class="btn" type="submit" name="save">Save</button>
        </div>
    </form>
    <table>
       <thead>
        <tr>
          <th>Pet ID</th>
          <th>Pet Name</th>
          <th colspan="2">Action</th>
    </tr>
    </thead>
    <?php
      $pets_list = $db->retrieve();

      while ($row = $pets_list->fetch_assoc()){
    ?> 
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td>
        <a href="edit.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
      </td>
      <td>
        <a href="pets.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
    
    <?php } ?>
    </table>
</body>
</html>
