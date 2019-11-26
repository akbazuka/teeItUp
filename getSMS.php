<?php

//require_once 'config.php';
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

try {
    $servername = "localhost";
    $username = "kedlaya";
    $password = "releasethekraken!";
    $databasename = "teeItUp";

    $timeID = $_POST['selectedTimeID'];
//    echo "The selected time is: ".$time;

//    $sql = "INSERT INTO bookings (userID, teeTimeID) VALUES (" . $_SESSION['id'] . "," . $timeID . ")";
//    $link->query($sql);
//
//    //For updating teeTimes table to show that teeTime that was booked is no longer available
//    $sql1 = "UPDATE `teeTime` SET `booked` = 1 WHERE `teeTime`.`teeTimeID` =  $timeID";
//    //$results = $conn->exec($sql);
//    $link->query($sql1);
    
        //Get user's phone number
    $sql6 = "SELECT `phoneNumber` FROM `users` WHERE `id`=" . $_SESSION['id'];
    $result6 = $link->query($sql6);

    if ($result6->num_rows > 0) {

        while ($row = $result6->fetch_assoc()) {
            $phone = $row["phoneNumber"];
        }
    }
//    } else {
//        echo "0 results for user's phone number";
//    }
    
    //Get user's emailNotification Preference
    $sql7 = "SELECT `phoneNotification` FROM `users` WHERE `id`=" . $_SESSION['id'];
    $result7 = $link->query($sql7);

    while ($row = $result7->fetch_assoc()) {
        $phoneNotify = $row["phoneNotification"];
    }
    
    //Get tee time and date for tee time ID
    $sql4 = "SELECT * FROM `teeTime` WHERE `teeTimeID`=" . $timeID;
    $result4 = $link->query($sql4);

    if ($result4->num_rows > 0) {

        while ($row = $result4->fetch_assoc()) {
            $dates_timesFormat = (explode(" ", date('Y-m-d H:i', strtotime($row['teeDateTime']))));
            $time = $dates_timesFormat[1];
            $date = $dates_timesFormat[0];
            
            $golfCourseID = $row['golfCourseID'];
        }
    }
//    } else {
//        echo "0 results for times, dates and golf course id";
//    }

    //Get golf course name
    $sql5 = "SELECT `golfCourseName` FROM `golfCourse` WHERE `golfCourseID`=" . $golfCourseID;
    $result5 = $link->query($sql5);

    if ($result5->num_rows > 0) {

        while ($row = $result5->fetch_assoc()) {
            $golfCourseName = $row['golfCourseName'];
        }
    }
//    } else {
//        echo "0 results for golf course";
//    }
    
    echo json_encode(array("phoneNotify"=>$phoneNotify,"phone"=>$phone,"time"=>$time,"date"=>$date,"golfCourseName"=>$golfCourseName));

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

