<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $dbconn = pg_connect("host=localhost port=5432 dbname=final user=w_user password=user") //connect to db as write user role: can onlyt update,select, insert
or die('Could not connect: ' . pg_last_error()); 

$error = @$_GET["error"];

//show error for bad username or incorrect password

if ($error == 1) {
  echo '<script type="text/javascript"> 

            window.onload = function () { alert("User already exists."); }
          </script>';
}
?>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #CF9A66;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
<script>  //fucntion to check if the passwords match before being submitted
  function checkPassword(form) {
                password1 = form.psw.value;
                password2 = form["psw-repeat"].value;
                      
                // If Not same return False.    
                if (password1 != password2) {
                    alert ("\nPassword did not match: Please try again...")
                    return false;
                }
            }
</script>
</head>
<body>

<form onSubmit="return checkPassword(this)" action="./scripts/addUser.php" method="POST" >
  <div class="container">
    <a href="//localhost" style="color: black;"><h1>Doncare</h1> </a>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
    <hr>
    <!--<div class="container">-->
      
        <div class="row">
          <div class="col-50">
            <label for="adr"><i class="fa fa-address-card-o"></i> <b>Address</b></label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> <b>City</b></label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state"><b>State</b></label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip"><b>Zip</b></label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>
          
        </div>
   <!-- </div> -->

    <button type="submit" class="registerbtn">Register</button>
  </div>
</form>


</body>
</html>