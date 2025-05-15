<?php
session_start();
include_once("DbHandler.php");
$db = new DbHandler();
$db->dbConnect();
// Check if the user is logged in
if(!isset($_SESSION["user"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit;
  }
if (isset($_GET['lab_id'])) {
    $lab_id = $_GET['lab_id'];
    
    $sql = "SELECT  lab_id, lab_type, num_devices, device_info, os, programs, temperature FROM labs WHERE lab_id = $lab_id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
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
                <a href="labsListF.php">Labs list</a>
                <a href="logout.php">Logout</a>
                <p style="color:white; margin-left: 200px; font-size: 50px; font-style: oblique;">Hello, <?php echo $_SESSION["user"]; ?>!</p>
            </nav>
    
            <main>
                <h2>Lab No.<?php echo $lab_id; ?></h2>
                <table class="lab">
                    <tr>
                        <td>Lab type :</td>
                        <td><?php echo $row['lab_type']; ?></td>
                    </tr>
                    <tr>
                        <td>Number of Devices :</td>
                        <td><?php echo $row['num_devices']; ?></td>
                    </tr>
                    <tr>
                        <td>Devices information :</td>
                        <td><?php echo $row['device_info']; ?></td>
                    </tr>
                    <tr>
                        <td>Operating system :</td>
                        <td><?php echo $row['os']; ?></td>
                    </tr>
                    <tr>
                        <td>Programs :</td>
                        <td><?php echo $row['programs']; ?></td>
                    </tr>
                    <tr>
                        <td>Lab temperature :</td>
                        <td><?php echo $row['temperature']; ?> °Celsius</td>

                    </tr>
                </table>
            </main>


            <script src="js/script.js"></script>
        </body>

        </html>
<?php
    } else {
        ?>
        <!DOCTYPE html>
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
                    <a href="labsList.php">Labs list</a>
                    <a href="logout.php">Logout</a>
                </nav>
    </body>
                </html>
    
        <?php
         echo "No results found";
    }
} else {
    ?>

    <!DOCTYPE html>
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
            <a href="labsListF.php">Labs list</a>
            <a href="logout.php">Logout</a>
        </nav>

        <section>
            <h2>Labs List</h2>
            <p style="color: red;">*</p>
            <p>Please select lab to show the report.</p>
            <table class="list">
                <tr>
                    <td><a href="labsListF.php?lab_id=1">Lab No.1</a></td>
                    <td><a href="labsListF.php?lab_id=2">Lab No.2</a></td>
                    <td><a href="labsListF.php?lab_id=3">Lab No.3</a></td>
                </tr>
                <tr>
                    <td><a href="labsListF.php?lab_id=4">Lab No.4</a></td>
                    <td><a href="labsListF.php?lab_id=5">Lab No.5</a></td>
                    <td><a href="labsListF.php?lab_id=6">Lab No.6</a></td>
                </tr>
            </table>
        </section>

        <script src="js/script.js"></script>
    </body>

    </html>
<?php
}
?>