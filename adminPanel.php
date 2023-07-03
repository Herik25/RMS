<?php
     $server = "localhost";
     $username = "root";
     $password = "";
     $database = 'rms';
 
     $con = mysqli_connect($server, $username, $password, $database);
 
     if (!$con) {
         die("connection to this database failed due to ".mysqli_connect_error());
     }
    //  echo "connected";

    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['ctgr'])) {

        $name = $_POST['name'];
        // $image = $_POST['image'];
        $price = $_POST['price'];
        $category = $_POST['ctgr'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            
            // Specify the directory to store images
            $uploadDir = './images/';
        
            // Generate a unique filename
            $uniqueFileName = uniqid() . '_' . $fileName;
        
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($fileTmpName, $uploadDir . $uniqueFileName)) {
                // File upload successful, store the file name in the database
                $image = $uploadDir . $uniqueFileName;
        
                $sql = "INSERT INTO `food` (`name`, `image`, `price`, `ctgr`) VALUES ('$name', '$image', '$price', '$category')";
                $result = mysqli_query($con, $sql);
        
                // if ($result) {
                //     echo "Item added successfully.";
                // } else {
                //     echo "Error: " . mysqli_error($con);
                // }
            } else {
                // echo "Error uploading file.";
            }
        } else {
            // echo "No file uploaded.";
        }
    }

    if (isset($_POST['oldname']) && isset($_POST['oldprice']) && isset($_POST['newname']) && isset($_POST['ctgr']) && isset($_POST['newprice'])) {
        $oldname = $_POST['oldname'];
        $oldprice = $_POST['oldprice'];
        $category = $_POST['ctgr'];
        $newname = $_POST['newname'] === "" ? $oldname : $_POST['newname'];
        $newprice = $_POST['newprice'] === "" ? $oldprice : $_POST['newprice'];

        if (isset($_FILES['newimage']) && $_FILES['newimage']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['newimage'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
    
            $uploadDir = './images/';
            $uniqueFileName = uniqid() . '_' . $fileName;
    
            if (move_uploaded_file($fileTmpName, $uploadDir . $uniqueFileName)) {
                $image = $uploadDir . $uniqueFileName;
    
                $sql = "UPDATE `food` SET `name` = '$newname', `image` = '$image', `price` = '$newprice' WHERE `name` = '$oldname' AND `price` = '$oldprice'";
                $result = mysqli_query($con, $sql);
    
            //     if ($result) {
            //         echo "Item updated successfully.";
            //     } else {
            //         echo "Error: " . mysqli_error($con);
            //     }
            // } else {
            //     echo "Error uploading file.";
            }
        } else {
            $sql = "UPDATE `food` SET `name` = '$newname', `price` = '$newprice' WHERE `name` = '$oldname' AND `price` = '$oldprice' AND `ctgr` = '$category'";
            $result = mysqli_query($con, $sql);
    
            // if ($result) {
            //     echo "Item updated successfully.";
            // } else {
            //     echo "Error: " . mysqli_error($con);
            // }
        }
    }

    if (isset($_POST['deletename']) && isset($_POST['deleteprice']) && isset($_POST['ctgr'])) {
        $deletename = $_POST['deletename'];
        $deleteprice = $_POST['deleteprice'];
        $category = $_POST['ctgr'];

        $sql = "DELETE FROM `food` WHERE `name` = '$deletename' AND `price` = '$deleteprice' AND `ctgr` = '$category' ";
        $result = mysqli_query($con, $sql);

        // if ($result) {
        //     echo "delted Item successfully";
        // } else {
        //     echo "error";
        // }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>adminpage</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .body{
            height: 100vh;
            width: 100%;
        }
        .container{
            display: flex;

        }
        .left{
            width: 20%;
            height: 100vh;
            background-color: #222;
        }
        li{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 10px;
        }
        li > img{
            height: 140px;
            width: 140px;
            border-radius: 10px;
            margin-bottom: 10px;
            
        }
        li > .title{
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;
            color: #fff;
        }
        .active{
            background-color: #444;
            width: 100%;
        }

        .right{
            width: 80%;
            height: 100vh;
            background: url('https://wallpapercave.com/wp/wp4289147.jpg');
            background-size: cover;
        }
        .layout{
            padding: 30px;
            display: flex;
            flex-wrap: wrap;
            overflow: auto;
            height: 100vh;
        }
        .card{
            height: 400px;
            width: 300px;
            margin: 20px;
            background-color: #e9e9e9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.7);
            /* display: none; */
        }
        .card2{
            height: 400px;
            width: 300px;
            margin: 20px;
            background-color: #e9e9e9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.7);
            /* display: none; */
        }
        .card3{
            height: 280px;
            width: 300px;
            margin: 20px;
            background-color: #e9e9e9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.7);
            /* display: none; */
        }
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 7px;
        }
        form > img{
            height: 200px;
            width: 280px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .insert{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input{
            margin-bottom: 10px;
            padding: 5px;
            border: none;
            outline: none;
            border-radius: 5px;
        }
        .pic{
            transform: translateX(40px);
        }
        .opt{
            font-family: sans-serif;
            margin-bottom: 7px;
            font-size: 13px;
        }
        .insert > button{
            width: 50%;
            background-color: #111021;
            color: #fff;
            padding: 4px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            outline: none;
            border-radius: 5px;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            cursor: pointer;
        }
        select{
           margin-block: 5px;
        }
        .line{
            height: 1px;
            width: 100%;
            background-color: #000;
            margin: 10px;
        }
        h1{
            padding: 10px;
            font-family:Arial, Helvetica, sans-serif;
        }
        .upd{
            display: flex;
            flex-direction: column;
            align-items: center;
            /* margin: 20px; */
        }
        .upd > input{
            margin: 10px;
        }
        .card2 > form > .insert > input{
            margin: 5px;
        }
        .card2 > form > .insert > button{
            margin: 10px;
        }
        .card3 > form > .insert > input{
            margin-block: 10px;
        }
        .card3 > form > .insert > button{
            margin: 10px;
        }
        .home-container{
            background-color: #171717;
            color: #fff;
            height: 60px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-family: sans-serif;
            font-weight: 600;
            cursor: pointer;
        }
        .icon{
            transform: translateY(2px);
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <ul class="left">
            <div class="home-container">
                <div class="home" onclick="home()">
                    <ion-icon class="icon" name="home-outline"></ion-icon><span>HOME</span>
                </div>
            </div>
            <li class="active">
                <img src="https://th.bing.com/th?id=OUG.37E2343F89DB28F95F8376BBDC7F13AA&w=236&h=320&c=7&rs=1&qlt=90&bgcl=ececec&o=6&pid=PersonalBing" alt="inventory">
                <div class="title">
                    Inventory
                </div>
            </li>
            <!-- <li>
                <img src="https://th.bing.com/th?id=OUG.3534FF4E5D38047E9600A22D971C4936&w=236&h=320&c=7&rs=1&qlt=90&bgcl=ececec&o=6&pid=PersonalBing" alt="table" class="inventory">
                <div class="title">
                    Reservation
                </div>
            </li> -->
        </ul>
        <div class="right">
            <div class="layout">
                <div class="card">
                    <form action="adminPanel.php" method="post" enctype="multipart/form-data">
                        <img src="https://media.istockphoto.com/id/1457889029/photo/group-of-food-with-high-content-of-dietary-fiber-arranged-side-by-side.jpg?s=612x612&w=is&k=20&c=n4-M3CyEMJdmZEsXN92sIQAxQPDJeGPX2tkBk1s_RtE=" alt="food">
                        <div class="insert">
                            <div class="opt">
                                Select Catagory :
                                <select name="ctgr" id="ctgr">
                                    <option value="fastfood">Fast Food</option>
                                    <option value="southindian">South Indian</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="deserts">Deserts</option>
                                    <option value="drinks">Drinks</option>
                                </select>
                            </div>
                            <input type="text" name="name" id="name" placeholder="Name of the Food" required=true>
                            <input type="file" name="image" id="image" required=true class="pic">
                            <input type="number" name="price" id="price" placeholder="Price of the Food" required=true>
                            <button>Add Item</button>
                        </div>
                    </form>
                </div>
                
                <div class="card2">
                    <form action="adminPanel.php" method="post" enctype="multipart/form-data">
                        <h1>UPDATE ITEM</h1>
                        <div class="line"></div>
                        <div class="insert">
                            <div class="opt">
                                Select Catagory :
                                <select name="ctgr" id="ctgr">
                                    <option value="fastfood">Fast Food</option>
                                    <option value="southindian">South Indian</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="deserts">Deserts</option>
                                    <option value="drinks">Drinks</option>
                                </select>
                            </div>
                            <div class="upd">
                                <input type="text" name="oldname" id="oldname" placeholder="Enter old name" required=true>
                                <input type="number" name="oldprice" id="oldprice" placeholder="Enter old price" required=true>
                            </div>
                            <div class="line"></div>
                            <input type="text" name="newname" id="newname" placeholder="Enter New Name">
                            <input type="file" name="newimage" id="newimage" class="pic" >
                            <input type="number" name="newprice" id="newprice" placeholder="Enter New Price">
                            <button class="updBtn">Update Item</button>
                        </div>
                        
                    </form>
                </div>
                
                <div class="card3">
                    <form action="adminPanel.php" method="post" enctype="multipart/form-data">
                        <h1>Delete Item</h1>
                        <div class="line"></div>
                        <div class="insert">
                            <div class="opt">
                                Select Catagory :
                                <select name="ctgr" id="ctgr">
                                    <option value="fastfood">Fast Food</option>
                                    <option value="southindian">South Indian</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="deserts">Deserts</option>
                                    <option value="drinks">Drinks</option>
                                </select>
                            </div>
                            <input type="text" name="deletename" id="deletename" placeholder="Name of the Food" required=true>
                            <input type="number" name="deleteprice" id="deleteprice" placeholder="Price of the Food" required=true>
                            <button>Delete Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const list = document.querySelectorAll('li');

        function clk() {
            list.forEach((item) => 
                item.classList.remove('active'));
                this.classList.add('active');
        }

        list.forEach((item) => 
            item.addEventListener('click', clk)
        )

        function home() {
            window.location.href = '/RMS/';
        }
    </script>
</body>
</html>