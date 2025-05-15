<?php 
require_once ('Database.php');

if (isset($_POST["submit"])){

$pid = $_REQUEST['id'];
$description=$_POST['description'];
$price=$_POST['price'];
$quantity=$_POST['qty'];

$obj1 = new Database();
$obj1->dbConnect();

$result=$obj1->insert($pid,$description,$price,$quantity);

if($result){
    echo "inserted";
   // header("location: addproduct.php?status=1");
    }
    else {
    echo "not inserted";
  }
}
?>


<main class='container'>
    <form action="" method="POST" style="max-width:900px">
    <h1>Product Reqistration</h1>
<?php 
   // if (isset($status) && $status == 1)
    //echo "inserted";
 //else echo "not inserted";
    ?> 
    <div class= "form-group">
    <label>Product ID</label>
    <input type="text" name="id" class="form-control">
   </div>
    <div class="form-group">
    <label>description</label>
    <input type="text" name="description" class="form-control">
   </div>
    <div class="form-group">
    <label>price</label>
    <input type="text" name="price" class="form-control">
   </div>
   <div class="form-group">
    <label>Quantity</label>
    <input type="text" name="qty" class="form-control">
  </div>
<input type="submit" name="submit" value="submit" class="btn btn-primary">
</form>
</main>

