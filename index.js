 //admin button
var adminButton = document.getElementById('admin');
adminButton.addEventListener('click', () => {
    history.pushState(null,'','/RMS/admin.php');
    handleRoute();
})

function handleRoute() {
    var path = window.location.pathname;
    var admin = document.getElementById('admin-container')
    if (path === '/RMS/admin.php') {
       window.location.reload();
    } else {
        admin.textContent = '404 Page not found';
    }
}

//add items
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