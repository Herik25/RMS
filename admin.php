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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Karla&family=Luckiest+Guy&family=Open+Sans&family=Poppins&family=Ubuntu&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Document</title>
    <style>
        body{
            background-color: #d9dddc;
            overflow: hidden;
        }
        .container{
            height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .login{
            display: flex;
            flex-direction: column;
            height: 350px;
            width: 360px;
            background-color: #e7e9ec;
            align-items: center;
            border-radius: 20px;
            position: relative;
        }
        .title{
            margin-top: 30px;
            font-family: 'poppins' , sans-serif;
            font-size: 40px;
        }
        .line{
            display: inline;
            width: 100%;
            height: 2px;
            background-color: #FFF;
            z-index: 2;
            margin-top: 30px;
        }
        input{
            width: 100%;
            padding: 12px;
            margin-bottom: 30px;
            border-radius: 10px;
            outline: none;
            border: none;
        }
        .inp{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
            position: relative;
        }
        .sub{
            border-radius: 5px;
            width: 60%;
            padding: 5px;
            font-size: 15px;
            font-weight: 700;
            font-family: sans-serif;
            border: 2px solid #000;
            background-color: #e7e9ec;
        }
        .sub:hover{
            background-color: #555;
            color: #fff;
            transition: 0.3s;
        }
        .error{
            display: flex;
            justify-content: center;
            align-items: center;
            color: red;
            font-size: 14px;
            position: absolute;
            bottom: 13%;
            width: 300px;
            font-family: 'Poppins', sans-serif;
        }

        .home{
            position: absolute;
            left: 2%;
            top: 1%;
            font-size: 30px;
            cursor: pointer;
        }
        
    </style>
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
    
    <!-- <button id="home" onclick="goto()">HOME</button> -->
    
    <script>
        var login = document.getElementById('login')
        var but = document.getElementById('home')
        var sub = document.getElementById('sub')
        // function goto(){
        //     window.location.href = '/RMS'
        // }
        var log = "<?php echo $login ?>";
        console.log(log);
        if (log === "loged in") {
            window.location.href = '/RMS/adminPanel.php';
        }

        function home(){
            window.location.href = '/RMS/';
        }
    </script>
</body>
</html>