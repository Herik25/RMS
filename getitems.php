<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = 'rms';

    $con = mysqli_connect($server, $username, $password, $database);

    if (!$con) {
        die("connection to this database failed due to ".mysqli_connect_error());
    }

    if (isset($_GET['ctgr'])) {
        $category = $_GET['ctgr'];
        
        // Use proper escaping to prevent SQL injection
        $safeCategory = mysqli_real_escape_string($con, $category);

        $sql = "SELECT * FROM `food` WHERE `ctgr` = '$safeCategory'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);

        $items = array();
        if ($num > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $items[] = $row;
            }
        }

        // Return the items as JSON response
        header('Content-Type: application/json');
        echo json_encode($items);
    }
?>
