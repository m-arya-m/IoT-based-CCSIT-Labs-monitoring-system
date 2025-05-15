<?php
 include_once("DbHandler.php");

 $db = new DbHandler();
 $db -> dbConnect();

 if (isset($_GET['edit'])){
     $id = $_GET['edit'];
     $result = $db->search_id($id);
    }

 if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name =$_POST['name'];

    $update_result = $db->update($id, $name);

    if ($update_result){
        header("Location: pets.php");
    }
}
?> 

<!DOCTYPE html>
 <html>
     <head>
         <title>CURD: PETS- UPDATE</title>
         <link rel="stylesheet" type="text/css" href="styles.css">
     </head>
     <body>
          <form method="post" action="edit.php">
             <h1>CURD: PETS- UPDATE</h1>
             <?php $row = $result->fetch_assoc(); ?>
               <div class="input-group">
                  <label> Pet ID</label>
                 <input type="text" name="id" value="<?php echo $row['id']; ?> ">
               </div>
               <div class="input-group">
                 <label> Pet Name</label>
                 <input type="text" name="name" value=" <?php echo $row['name']; ?> ">
               </div>
               <div class="input-group">
                 <button class="btn" type="submit" name="update">Update</button>
                 </div>
         </form>
     </body>
</html>
