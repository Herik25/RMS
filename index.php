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

    if (isset($_GET['ctgr'])) {
        $category = $_GET['ctgr'];
        
        $sql = "SELECT * FROM `food` WHERE `ctgr` = '" . $category . "'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
    } else {
        $category = 'fastfood'; // Set 'fastfood' as the default category
        $sql = "SELECT * FROM `food` WHERE `ctgr` = '$category'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Karla&family=Luckiest+Guy&family=Open+Sans&family=Poppins&family=Ubuntu&display=swap" rel="stylesheet">
    <title>RMS</title>
</head>
<body>
   <div class="container">
        <div class="main">

            <!-- left side -->

            <div class="leftPanel">
                <ul class="ctgr">
                    <li id="fastfood" class="active">
                        <img src="https://th.bing.com/th/id/OIP.MYrVEIwwKi2UiC55nj5KJgHaGJ?pid=ImgDet&rs=1" alt="burger" height="100px" width="100px">
                        <div class="title">
                            Fast Foods
                        </div>
                    </li>

                    <li id="southindian">
                        <img src="https://th.bing.com/th/id/OIP.9MfNFYWqS-xzcl3XoPTMIwHaHa?pid=ImgDet&rs=1" alt="dosa">
                        <div class="title">
                            South Indian
                        </div>
                    </li>

                    <li id="chinese">
                        <img src="https://th.bing.com/th/id/R.2f106f02742dfca0c8e9f206b4b4a97a?rik=KsOhYeh1Z8Z27A&riu=http%3a%2f%2fmagazine.foodpanda.pk%2fwp-content%2fuploads%2fsites%2f13%2f2016%2f06%2fChinese-Featured-Image.jpg&ehk=vIhaprTmcXRQTE0oWa1Dcm9gx6wELUQTBKyDbP0hAKU%3d&risl=&pid=ImgRaw&r=0" alt="chinese">
                        <div class="title">
                            Chinese
                        </div>
                    </li>

                    <li id="deserts">
                        <img src="https://images.unsplash.com/photo-1551024601-bec78aea704b?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8ZGVzc2VydHxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&w=1000&q=80" alt="Deserts">
                        <div class="title">
                            Deserts
                        </div>
                    </li>

                    <li id="drinks">
                        <img src="https://news.harvard.edu/wp-content/uploads/2019/03/beverage-3548084_1920-1.jpg?w=1200&h=800&crop=1" alt="coldDrink">
                        <div class="title">
                            Drinks
                        </div>
                    </li>
                </ul>
            </div>

            <!-- right side -->

            <div class="rightPanel">
                <div class="items">
                    <?php

                    if ($num > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <div class="card">
                                    <img src="' . $row['image'] . '" alt="ff" class="cardImg">
                                    <div class="name">
                                        ' . $row['name'] . '
                                    </div>
                                    <div class="price">
                                        <span class="prc">' . $row['price'] . '</span> ₹  
                                    </div>
                                    <div class="quantity">
                                        Quntity : <input type="number" name="qty" id="qty" class="qty" value="1" placeholder="Quntity">
                                    </div>
                                    <button class="addItem">Add Item</button>
                                </div>
                            ';
                        }
                    }
                    ?>
                </div>

            </div>
        </div>

        <!-- bottom Panel -->

        <div class="bottomPanel">
            <div class="numItem">
                <h3>Number Of Items : </h3>&nbsp;<div class="itemCount" id="itemCount">0</div>
            </div>
            <div class="tot">
                <h3>TOTAL : </h3>&nbsp; <div class="total">0</div>&nbsp;<span class="rupee">₹</span>
            </div>
            <div class="pay">
                <button class="paynow" onclick="paynow()">Pay Now</button>
            </div>
            <div class="show">
                <button class="showbill" onclick="showBill()">Show Bill</button>
            </div>
            <div class="bottomItems">
                <button class="admin" id="admin">Admin Panel</button>
            </div>
        </div>
   </div>

   <div class="bill">
       <h2>Bill</h2>
       <div class="line"></div>
       <div class="billTitle">
           <div>srno</div><div>items</div><div>Quntity</div><div>price</div>
       </div>
       <div class="line"></div>
       <div class="billItems" id="billitems">
           
       </div>
       <div class="line"></div>
       <div class="billTotal">

       </div>
       <div class="gst">
        <div class="tax">
            SGST @9% : &thinsp;<span id="cgst">0</span>
        </div>
        <div class="tax2">
            CGST @9% : <span id="sgst">0</span>
        </div>
        <div class="tax3">
            Round Off : <span id="roundOff"> 0</span>
        </div>
        <div class="line"></div>
        <div class="tax4">
            GRAND TOTAL : <span id="gTotal"> 0</span><span class="rupee"> ₹</span>
        </div>
       </div>
   </div>

   <div id="admin-container">
   </div>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./script.js"></script>
    <script>
        // click effect on left panel
        const list = document.querySelectorAll('li');
        var id = null;

        function retrive() {
            $.ajax({
                    url: 'getitems.php',
                    method: 'GET',
                    data: { ctgr: `${id}` },
                    success: function (response) {
                        // Process the JSON response and update the right panel
                        // with the retrieved items.
                        if (response.length > 0) {
                            var itemsHTML = '';
                            response.forEach(function(item) {
                                itemsHTML += `
                                    <div class="card">
                                        <img src="${item.image}" alt="ff" class="cardImg">
                                        <div class="name">
                                            ${item.name}
                                        </div>
                                        <div class="price">
                                            <span class="prc">${item.price}</span> ₹
                                        </div>
                                        <div class="quantity">
                                            Quntity : <input type="number" name="qty" id="qty" class="qty" value="1" placeholder="Quntity">
                                        </div>
                                        <button class="addItem">Add Item</button>
                                    </div>
                                `;
                            });
                            document.querySelector('.items').innerHTML = itemsHTML;
                        }
                    },
                        error: function (xhr, status, error) {
                        console.error(error);
                        }
                    });
        }

        function clk() {
            list.forEach((item) => item.classList.remove('active'));
                this.classList.add('active');
                id = this.id;
                if (id === 'fastfood') {
                    retrive(id);
                    

                } else if (id === 'southindian') {
                    
                    retrive(id);

                } else if (id === 'chinese') {
                    
                    retrive(id);
                    
                } else if (id === 'deserts') {
                    
                    retrive(id);
                    
                }else if (id === 'drinks') {
                    
                    retrive(id);
                    
                }


        }

        list.forEach((item) => 
        item.addEventListener('click', clk)
        )

        //add Itmes

        var cardItems = [];
        var count = 0;
        var itemCount = document.getElementById('itemCount');
        var amoount = document.querySelector('.total');
        var bill = document.querySelector('.bill');
        var billItems = document.getElementById('billitems');
        var billTotal = document.querySelector('.billTotal');
        function getTotalPrice() {
            var totalPrice = 0;
            for (let i = 0; i < cardItems.length; i++) {
                var items = cardItems[i];
                var price = parseFloat(items.price * items.quantity);
                totalPrice += price;
            }
            return totalPrice;
        }

        function getTotalQuantity() {
            var totalQuantity = 0;
            for (let i = 0; i < cardItems.length; i++) {
                var items = cardItems[i];
                var quantity = parseFloat(items.quantity);
                totalQuantity +=  quantity;
            }
            return totalQuantity;
        }

        document.querySelector('.items').addEventListener('click', function(event) {
            if (event.target.classList.contains('addItem')) {
                handleAddItemClick(event.target);
            }
        })

        var qty = document.querySelector('.qty');
        function handleAddItemClick(button) {
            var card = button.parentNode;
            var quantity = card.querySelector('.quantity');
            quantity.style.display = "flex";
            if (button.innerText === 'Confirm') {
                confirm(card);
                quantity.style.display = "none";
                button.innerText = "Add Item";
            } else {
                button.innerText = "Confirm";
            }
        }
        
        // var addItem = document.querySelectorAll('.addItem');
        // addItem.forEach((button) => {
        //     button.addEventListener('click', handleAddItemClick);
        // })

        var cgst = document.getElementById('cgst');
        var sgst = document.getElementById('sgst');
        var rOff = document.getElementById('roundOff');
        var gTotal = document.getElementById('gTotal');
        var grandTotal = 0;
        var value = 0;

        function confirm(card) {

            while (card && !card.classList.contains('card')) {
                card = card.parentNode;
            }

            if (card) {
            var cardImg = card.querySelector('.cardImg');
            var name = card.querySelector('.name').innerText;
            var price = card.querySelector('.prc').innerText;
            var qty = card.querySelector('.qty').value;

            if (qty < 0 || qty == 0) {
                alert('Please Inter a Valid Quantity');
                qty = 0;
            } else {
                var item = {
                    name: name,
                    price: price,
                    quantity: qty,
                };
            }

            // alert('Clicked "Add Item" button:\nName: ' + name + '\nPrice: ' + price);

            cardItems.push(item);
            console.log(cardItems);

            count++;
            var totalPrice = getTotalPrice();
            // tax
            var sgstTax = calSgst(totalPrice);
            var cgstTax = calCgst(totalPrice);
            
            itemCount.textContent = getTotalQuantity();
            amoount.innerText = totalPrice;
            sgst.innerText = sgstTax;
            cgst.innerText = cgstTax;
            
                subTotal = totalPrice + sgstTax + cgstTax;
                roundOff =  Math.round(subTotal)
                val = roundOff - subTotal;
                
                value = val;
                grandTotal = subTotal;
            
            rOff.innerText = value.toFixed(2);
            gTotal.innerText = parseInt(grandTotal)

            // console.log(val.toFixed(2));
            // console.log(parseInt(grandTotal));
            }
        }

        function paynow(){
            window.location.reload();
        }

        function calSgst(total) {
            return (total * 9)/100;
        }

        function calCgst(total) {
            return (total * 9)/100;
        }

        function showBill() {
            if (bill.style.visibility === "hidden") {
                bill.style.visibility =  "visible";
            } else {
                bill.style.visibility =  "hidden";
            }
            billItems.innerHTML = '';
            for (let i = 0; i< cardItems.length; i++) {
                var item = cardItems[i];
                var itemHtml = `
                    <div>${i+1}</div> <div>${item.name}</div> <div>${item.quantity}</div> <div>${item.price * item.quantity} <span class="rupee">₹</span></div>      
                `;
                billItems.innerHTML += itemHtml
            }

            billTotal.innerHTML = ` Total : ${getTotalPrice()} <span class="rupee">₹</span>`;
            
        }
    </script>
</body>
</html>