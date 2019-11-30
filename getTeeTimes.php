<?php

ini_set('display_errors', 1);
//require_once 'config.php';
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

    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $date = $_POST["selectedDate"];
    $golfCourse = $_POST["selectedGolfCourseID"];

//    echo "This is the selected date: ".$date;
//    echo "\nThis is the selected golf course: ".$golfCourse;
//    $date = "2019-11-24";
//    $golfCourse = 1;
    //$date = str_replace('-', '/', $date);

    $sql = $conn->prepare("SELECT * FROM `teeTime` WHERE DATE(`teeDateTime`) = '" . $date . "' AND `golfCourseID` = " . $golfCourse . " ORDER BY TIME(`teeDateTime`)");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    $bookedTimes = array();
    $timesID = array();

    foreach ($result as $row) {
        array_push($bookedTimes, $row['booked']);
        array_push($timesID, $row['teeTimeID']);
    }

//    echo "\n These are booked times: ".print_r($bookedTimes);
//    echo "\n These are the time IDs: ".print_r($timesID);

    $times = array("10:00", "10:15", "10:30", "10:45", "11:00", "11:15", "11:30", "11:45", "12:00", "12:15", "12:30", "12:45");

    if (sizeof($bookedTimes) != 0) {

        //Loop displays tee time buttons
        for ($x = 0; $x < sizeof($times); $x++) {

            if ($bookedTimes[$x] == 1 && $x == 0) {
                echo "<tr><td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</div></td>";
            } else if ($bookedTimes[$x] != 1 && $x == 0) {
                echo"<tr><td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td>";
            } else if ($bookedTimes[$x] != 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td></tr><tr>";
            } else if ($bookedTimes[$x] == 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</button></td></tr><tr>";
            } else if ($bookedTimes[$x] == 1 && $x == (count($times) - 1)) {
                echo "<td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</button></td></tr>";
            } else if ($bookedTimes[$x] != 1 && $x == (count($times) - 1)) {
                echo "<td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td></tr>";
            } else if ($bookedTimes[$x] == 1 && $x != 0) {
                echo "<td><button class='btn_off'>$times[$x]</button></td>";
            } else
                echo "<td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td>";
        }
    }
    else echo "<br><br><br><br><h2 style='color:black'>Sorry,<br>Tee times for this golf course on this date have not been entered yet.</h2>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

