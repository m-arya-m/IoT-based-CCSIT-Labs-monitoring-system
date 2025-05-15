<?php 
include_once("Database.php");

$obj1 = new Database();
$obj1 -> dbConnect();

if (isset($_GET["id"])){
   
$result = $obj1 -> retrieve ($_GET["id"]);
$row = $result->fetch_assoc();

}
?>

<table broder="1px">
   <tr><th>PID</th><th>Description</th><th>Price</th><th>Quantity</th></tr>
   <tr>
      <td> <?php echo $row ['pid']; ?></a></td>
      <td> <?php echo $row ['description']; ?></td>
      <td> <?php echo $row ['price']; ?></td>
      <td> <?php echo $row ['quantity']; ?></td>
</tr>
</table>