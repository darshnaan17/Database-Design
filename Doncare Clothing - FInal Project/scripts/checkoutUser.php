<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbconn = pg_connect("host=localhost port=5432 dbname=final user=w_user password=user")
or die('Could not connect: ' . pg_last_error());
$user = test_input($_POST["uname"]);
$password = test_input($_POST["psw"]);
$order=test_input($_POST["orderID"]);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$userName = pg_query($dbconn, "SELECT * FROM users WHERE email='$user'"); //check if user exists for checkout
$row = pg_fetch_row($userName);
//$hash = password_hash($password, PASSWORD_DEFAULT);
if ($row == false || $row[1] != $password) {  //throw error if password is incorrect or user doesnt exist
    header("Location: //localhost/checkout.php?order=$order&error=1");
    exit();
}

$getAddID = pg_query($dbconn, "SELECT addressid FROM have WHERE email='$user'");  //grab address attached to user
$row = pg_fetch_row($getAddID);

$addQ = pg_query($dbconn, "SELECT * FROM addresses WHERE addressid='$row[0]'");
$row = pg_fetch_row($addQ);


header("Location: //localhost/checkout.php?order=$order&email=$user&city=$row[1]&state=$row[2]&zip=$row[3]&address=$row[4]"); //fill user info for checkout.php
exit();
?>