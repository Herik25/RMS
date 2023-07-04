<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = 'user';

    $con = mysqli_connect($server, $username, $password, $database);

    if (!$con) {
        die("connection to this database failed due to ".mysqli_connect_error());
    }
    // echo "Succesfully connected to db";

if (isset($_POST['user']) && isset($_POST['pass'])) {

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT `user`, `pass` FROM `user` WHERE `srno` = '1'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // echo " username is ". $row['user']. " and password is " . $row['pass'] . "<br>";
            if ($user === $row['user'] && $pass === $row['pass']) {
                // echo "login successfull";
                $login = "loged in";
            } else if ($user === $row['user'] && $pass !== $row['pass'] ) {
                // echo "password is incorrect";
                $login = "incorrect pass";
            } else if ($user !== $row['user']){
                // echo "please check your username or password";
                $login = "incorrect user";
            }
        }
    }
} else {
    $login = "user not found";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Karla&family=Luckiest+Guy&family=Open+Sans&family=Poppins&family=Ubuntu&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="login">
        <div class="home">
            <div onclick="home()"><ion-icon name="home-outline"></ion-icon></div>
        </div>
            <div class="title">
                Hello user
            </div>
            <div class="line"></div>
                <form action="admin.php" id="'login" class="inp" method="post">
                    <input type="text" id="user" name="user" placeholder="Enter Your Name" required=true>
                    <?php
                        if ($login === "incorrect user") {
                            echo "<p class='error'>please check your username or password</p>";
                        }
                    ?>
                    <input type="password" name="pass" id="pass" placeholder="Enter Your password" required=true>
                    <?php
                        if ($login === "incorrect pass") {
                            echo "<p class='error'>your password is incorrect</p>";
                        }
                    ?>

                    <button class="sub" id="sub">Submit</button>
                </form>
        </div>
    </div>
    <script>
       var log = "<?php echo $login ?>";
    </script>
    <script src="./admin.js"></script>
</body>
</html>