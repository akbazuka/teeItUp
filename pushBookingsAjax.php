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
require_once 'phpmailer/class.phpmailer.php';
include 'phpmailer/class.smtp.php';

try {
    $servername = "localhost";
    $username = "kedlaya";
    $password = "releasethekraken!";
    $databasename = "teeItUp";

    /* Attempt to connect to MySQL database */
    //$conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /* //For checking if there are missing times
      $stmt = $conn->prepare("SELECT (`teeDateTime`) FROM `teeTime` WHERE `golfCourseID`='" . $courseID . "'");
     * */

    //For pushing tee time into bookings table
    //$userID = $POST_['userID'];
    //echo "This is the user ID: ".$userID;

    $timeID = $_POST['selectedTimeID'];
    //echo "\nThis is the selected time: ".$time;
    //$stmt1 = $conn->prepare("INSERT INTO `bookings` (`bookingID`, `userID`, `teeTimeID`) VALUES (NULL, '1','".$time."')");
    //
//    $date = $_POST['selectedDate'];
//    
    //$_SESSION["id"] is the user id; being taken directly from the session rather than push via jQuery
    //$stmt1 = $conn->prepare("INSERT INTO bookings (userID, teeTimeID) VALUES (" . $_SESSION['id'] . "," . $timeID . ")");
    //$stmt1->execute();
    $sql = "INSERT INTO bookings (userID, teeTimeID) VALUES (" . $_SESSION['id'] . "," . $timeID . ")";
    $link->query($sql);

    //For updating teeTimes table to show that teeTime that was booked is no longer available
    $sql1 = "UPDATE `teeTime` SET `booked` = 1 WHERE `teeTime`.`teeTimeID` =  $timeID";
    //$results = $conn->exec($sql);
    $link->query($sql1);

    //$sql1 = $conn->prepare("SELECT `email` FROM `users` WHERE `id`=" . $_SESSION['id']);
    //$sql1->execute();
    //$results1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
    
    //Get user's email
    $sql2 = "SELECT `email` FROM `users` WHERE `id`=" . $_SESSION['id'];
    $result2 = $link->query($sql2);

    if ($result2->num_rows > 0) {

        while ($row = $result2->fetch_assoc()) {
            $email = $row["email"];
        }
    } else {
        echo "0 results for user's eamil";
    }
    
    //Get user's emailNotification Preference
    $sql3 = "SELECT `emailNotification` FROM `users` WHERE `id`=" . $_SESSION['id'];
    $result3 = $link->query($sql3);

    while ($row = $result3->fetch_assoc()) {
        $emailNotify = $row["emailNotification"];
    }
    //echo "This is the value of email: ".$emailNotify;
    
        //Get user's phone number
    $sql6 = "SELECT `phoneNumber` FROM `users` WHERE `id`=" . $_SESSION['id'];
    $result6 = $link->query($sql6);

    if ($result6->num_rows > 0) {

        while ($row = $result6->fetch_assoc()) {
            $phone = $row["phoneNumber"];
        }
    } else {
        echo "0 results for user's phone number";
    }
    
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
    } else {
        echo "0 results for times, dates and golf course id";
    }

    //Get golf course name
    $sql5 = "SELECT `golfCourseName` FROM `golfCourse` WHERE `golfCourseID`=" . $golfCourseID;
    $result5 = $link->query($sql5);

    if ($result5->num_rows > 0) {

        while ($row = $result5->fetch_assoc()) {
            $golfCourseName = $row['golfCourseName'];
        }
    } else {
        echo "0 results for golf course";
    }
    
    //$email = $results1[0]['email'];
//    // set the resulting array to associative  
//    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
//
//    //json encode to be used in javascript
//    $json = json_encode($result1);
//    echo $json;
    //{USER}, {TIME}, {DATE}, {COURSE}
    
    //echo json_encode(array($phoneNotify,$phone,$time,$date,$golfCourseName));

    //Makes emai reusable for different variables by creating an array to process  email body
    $email_vars = array(
        'user' => $_SESSION['username'],
        'time' => $time,
        'date' => $date,
        'course' => $golfCourseName
    );

    //Replaces words with varibales from array above in the email template
    $body = file_get_contents('phpmailer/TeeItUpMail.php');

    if (isset($email_vars)) {
        foreach ($email_vars as $k => $v) {
            $body = str_replace('{' . strtoupper($k) . '}', $v, $body);
        }
    }

    //PHP Mailer; send confirmation email to use when booking is made-----------
    
    //$body = file_get_contents('phpmailer/TeeItUpMail.php');
    
        //This config for go daddy hosting (has high security measures)
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug=2;                              
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->Port = 25;
        $mail->setFrom('team@kedlena.com','Tee It Up! Team');

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->addAddress($email);

        $mail->addAddress($email);
        $mail->Subject = 'Tee It Up- Booking Confirmation';
        $mail->msgHTML($body);
        //If current user's preference is to get emails.   
        if($emailNotify==1){
            $mail->send();
        }

//        $mail = new PHPMailer(true);
//        $mail->isSMTP();          
//        $mail->SMTPDebug=2;
//        $mail->Host       = 'smtp.gmail.com';                   
//        $mail->Port       = 465;                                    
//        $mail->SMTPSecure = 'ssl';
//        $mail->SMTPAuth = true;                                   
//        $mail->Username   = 'hpu.taskmanager@gmail.com';                    
//        $mail->Password   = 'HPU12345';                              
//        $mail->setFrom('hpu.taskmanager@gmail.com', 'HPU Task-Manager (Team 6)');
//        $mail->CharSet = 'UTF-8';
//        $mail->isHTML(true);
//    
//        $mail->addAddress('akedlaya@my.hpu.edu');
//        $mail->Subject = "Confirmation: You booked a tee time!";
//        $mail->msgHTML($body1);
//        $mail->send();     
//        
//    if (!$mail->send()) {
//        echo '<h1 style="font-weight: bold; color: black;>Message was not sent.</h1>';
//        echo '<h1 style="font-weight: bold; color: black;">Mailer error: ' . $mail->ErrorInfo.'</h1>';
//    } else {
//        echo 'Message has been sent.';
//    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

