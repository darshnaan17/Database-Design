<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbconn = pg_connect("host=localhost port=5432 dbname=final user=w_user password=user")
or die('Could not connect: ' . pg_last_error());

$name = $_POST["name"];
$email = $_POST["email"];
$addressid = uniqid();
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];

$custId = uniqid();
$orderID = $_POST["orderID"];

echo $orderID;

$addAdd = "INSERT INTO addresses VALUES ('$addressid', '$city', '$state', '$zip', '$address')";
$addCust = "INSERT INTO customers VALUES ('$custId', '$name', '$email', '$orderID', '$addressid')";
$resultAdd = pg_query($dbconn, $addAdd);
$resultCust = pg_query($dbconn, $addCust);

header('Location: //localhost/customerinfo.php');

if (!$resultCust || !$resultAdd) {
    echo "Error while executing the query: ";
    exit;
}
// or die();
  exit();

?>