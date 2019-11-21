<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

try {
    $servername = "localhost";
    $username = "kedlaya";
    $password = "releasethekraken!";
    $databasename = "teeItUp";

    /* Attempt to connect to MySQL database */
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $bookingID = $_POST['bookingID'];
//    echo "\nThis is the bookingId time: ".$bookingID."\n";
    
    $stmt8 = $conn->prepare("SELECT `teeTimeID` FROM `bookings` WHERE `bookingID`= '".$bookingID."'");
    $stmt8->execute();
    $result8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
    
//    echo print_r($result8);
    
    $timeID = $result8[0]['teeTimeID'];
//    echo "The time ID is: ".$timeID;
    
    //For updating teeTimes table to show that teeTime that was booked is now available again
    $stmt9 = $conn->prepare("UPDATE `teeTime` SET `booked` = '0' WHERE `teeTime`.`teeTimeID` = '".$timeID."'");  
    $stmt9->execute();
    
    //For deleting booking
    $stmt10 = $conn->prepare("DELETE FROM `bookings` WHERE `bookingID` = '".$bookingID."'");   
    $stmt10->execute();
    
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


