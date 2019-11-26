<?php
ini_set('display_errors', 1);
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

try{
$phonePref = $_POST['phoneNotify'];

//Push email notification preference to database
$sql = "UPDATE `users` SET `phoneNotification` = ".$phonePref." WHERE `id` = " .$_SESSION['id'];
$link->query($sql);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

