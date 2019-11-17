<?php
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

    //For checking what the booked times are
    $stmt = $conn->prepare("SELECT * FROM `teeTime`");

    $stmt->execute();
    // set the resulting array to associative  
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //json encode to be used in javascript
    $json = json_encode($result);
    echo $json;
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>