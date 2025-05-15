<?php

require "Rectangle.php";

$obj1 = new Rectangle;
$obj2 = new Rectangle;

$obj1->setlength(30);
$obj1->setwidth (20);

$obj2->setlength(35);
$obj2->setwidth (50);

echo "object 1 area is: " . $obj1->getArea();
echo "<br>";
echo "object 2 area is: " . $obj2->getArea();
?>
