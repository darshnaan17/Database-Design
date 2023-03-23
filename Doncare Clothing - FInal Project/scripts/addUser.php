<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbconn = pg_connect("host=localhost port=5432 dbname=final user=w_user password=user")
or die('Could not connect: ' . pg_last_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") { //get input from register.php
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["psw"]);
  $addressid = uniqid();  //generate addressid
  $address = test_input($_POST["address"]);
  $city = test_input($_POST["city"]);
  $state = test_input($_POST["state"]);
  $zip = test_input($_POST["zip"]);
}

function test_input($data) {  //clean up inputvalues to prevent against SQL injection
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$checkUser = pg_query($dbconn, "SELECT email FROM users WHERE email='$email'"); //check if user already exists for registration
$row = pg_fetch_row($checkUser);
if ($row[0] == $email) {
  header("Location: //localhost/register.php?error=1");
  exit();
}


//insert new address, user, and vhave entry
$addAdd = "INSERT INTO addresses VALUES ('$addressid', '$city', '$state', '$zip', '$address')";
$addUser = "INSERT INTO users VALUES ('$email', '$password')";
$addHave = "INSERT INTO have VALUES ('$email', '$addressid')";

$resultAdd = pg_query($dbconn, $addAdd);
$resultUser = pg_query($dbconn, $addUser);
$resultHave = pg_query($dbconn, $addHave);

header('Location: //localhost');
// or die();
  exit();




?>