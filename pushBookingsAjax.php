<?php
include_once "title.php";

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

    /* //For checking if there are missing times
      $stmt = $conn->prepare("SELECT (`teeDateTime`) FROM `teeTime` WHERE `golfCourseID`='" . $courseID . "'");
     * */

    //For pushing tee time into bookings table
    //$userID = $POST_['userID'];
    //echo "This is the user ID: ".$userID;
    
    $time = $_POST['selectedTimeID'];
    //echo "\nThis is the selected time: ".$time;
    //$stmt1 = $conn->prepare("INSERT INTO `bookings` (`bookingID`, `userID`, `teeTimeID`) VALUES (NULL, '1','".$time."')");
    
    //$_SESSION["id"] is the user id; being taken directly from the session rather than push via jQuery
    $stmt1 = $conn->prepare("INSERT INTO `bookings` (`bookingID`, `userID`, `teeTimeID`) VALUES (NULL, '".$_SESSION["id"]."','".$time."')");   
    $stmt1->execute();
    
    //For updating teeTimes table to show that teeTime that was booked is no longer available
    $sql = "UPDATE `teeTime` SET `booked` = '1' WHERE `teeTime`.`teeTimeID` = '".$time."';";  
    $results = $conn->exec($sql);
//    // set the resulting array to associative  
//    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
//
//    //json encode to be used in javascript
//    $json = json_encode($result1);
//    echo $json;
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
