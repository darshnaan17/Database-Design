<!DOCTYPE html>
<html>
<head>
<?php
// Connecting, selecting database
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
$dbconn = pg_connect("host=localhost port=5432 dbname=final user=read_user password=user")
    or die('Could not connect: ' . pg_last_error());

$name = @$_GET["name"];
$email = @$_GET["email"];
$address = @$_GET["address"];
$city = @$_GET["city"];
$state = @$_GET["state"];
$zip = @$_GET["zip"];

$error = @$_GET["error"];
if ($error == 1) {  //catch error for a user that doesn't exist from checkoutUser.php
  echo '<script type="text/javascript">

            window.onload = function () { alert("User does not exist or the password is incorrect."); }
          </script>';
}

$orderId = $_GET["order"];
$cart = pg_query($dbconn, "SELECT productname, price FROM products WHERE productid='$orderId'");  //get product info to display 
$row = pg_fetch_row($cart); 
if ($error == 2) {  //catch error from newConf.php
  echo "<script type='text/javascript'> 

            window.onload = function () { alert('Item is out of stock or does not exist.'); }
          </script>";
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./styleLogin.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
  background-image: url("./img/1.jpg");
  background-repeat: repeat;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #CF9A66;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #E7AB6F;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>


</head>
<body>

<h1><a href="//localhost" style="color: black; background-color: white;">Doncare</a></h1>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="./newConf.php" method="POST">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="name"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="name" name="name" placeholder="John More Doe" value="<?php if(is_null($name)) {echo "";} else {echo $name;} ?>" required> <!--echo data returned from checkoutUser.php-->
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com" value="<?php if(is_null($email)) {echo "";} else {echo $email;} ?>" required>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" value="<?php if(is_null($address)) {echo "";} else {echo $address;} ?>" required>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York" value="<?php if(is_null($city)) {echo "";} else {echo $city;} ?>" required>
            <input type="hidden" name="orderID" value="<?php echo htmlspecialchars($orderId);?>" />

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY" value="<?php if(is_null($state)) {echo "";} else {echo $state;} ?>" required>
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001" value="<?php if(is_null($zip)) {echo "";} else {echo $zip;} ?>" required>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label> <!--card information is not stored in system -->
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h2>Already Have An Account?</h2>
      <button onclick="document.getElementById('id01').style.display='block'" style="width:auto; background-color: #CF9A66;">Login</button>

      <p><a href="./register.php">Register</a></p>

      <div id="id01" class="modal">
        
        <form class="modal-content animate" action="./scripts/checkoutUser.php" method="post">
          <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="./img/haribo.jpg" style="width: 100px;" alt="Avatar" class="avatar">
          </div>

          <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <input type="hidden" name="orderID" value="<?php echo htmlspecialchars($orderId);?>" />
              
            <button type="submit" style="background-color: #CF9A66;">Login</button>
          </div>
        </form>
      </div>

      <script>
      // Get the modal
      var modal = document.getElementById('id01');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      }
      </script>
    </div>
    <div class="container">
    <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4>
      <p><?php echo $row[0]?> <span class="price">$<?php echo $row[1]?></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b>$<?php echo $row[1]?></b></span></p>
    </div>
  </div>
</div>

</body>
</html>
