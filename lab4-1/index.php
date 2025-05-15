<?php 
require_once("Database.php");

$obj1 = new Database();
$obj1 -> dbConnect();
$result=$obj1 -> retrieveAll();
?>

<table border="1px">

<tr><th>PID</th><th>Description</th><th>Price</th><th>Quantity</th></tr>

<?php while ($row = $result->fetch_assoc()) { ?> 

<tr>
   <td><a href="productinfo.php?id=<?php echo $row['pid']; ?> "><?php echo $row['pid']; ?></a></td> 
   <td><?php echo $row['description']; ?> </td>
   <td><?php echo $row['price']; ?> </td>
   <td><?php echo $row['quantity']; ?> </td> 
</tr>

<?php 
}
?>
</table>