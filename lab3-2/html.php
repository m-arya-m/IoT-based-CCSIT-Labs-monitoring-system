
<!DOCTYPE html>
<html>
<head>
    <title>Area and Perimeter Calculator</title>
</head>
<body>
    <form method="GET" >
        <label for="length"></label>
        <input type="text" id="length" name="length" placeholder="Enter the length" required>
        <br>
        <label for="width"></label>
        <input type="text" id="width" name="width" placeholder="Enter the width" required>
        <br>
        <input type="submit" name="area" value="Area">
        <input type="submit" name="perimeter" value="Perimeter">
    </form>

    <?php
    include "Rectangle.php";
    if (isset($_GET['length']) && isset($_GET['width'])) { 
        $obj = new Rectangle ();  

        $length = $obj-> setlength( $_GET['length']);
        $width =  $obj-> setwidth ($_GET['width']);

        if (isset($_GET['area'])) {
            $area = $obj -> getArea ();
            echo "<h4>Area: $area</h4>";
        }

        if (isset($_GET['perimeter'])) {
            $perimeter = $obj -> getPerimeter () ;
            echo "<h4>Perimeter: $perimeter</h4>";
        }
    }
    ?>
</body>
</html>