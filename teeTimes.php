<?php
include_once "title.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<!--<link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:400"/>-->
<link rel="stylesheet" type="text/css" href="cssFiles/teeTimesCSS.css"/>

<body>
    <!import jQuery>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <br>
    <div class="user">
        &ensp;Signed in as <b><?php echo "<em>" . htmlspecialchars($_SESSION["username"]) . "</em>"; ?></b>
        <a href="logout.php" class="btn1 btn-danger" style="position: absolute; right: 30;">Sign Out</a>
    </div>
<center>
    <br>
    <br>
    <span id="subtitle">&ensp;<?php
        $courseName = $_GET['courseName'];
        $courseID = 0;
        switch ($courseName) {
            case "royal":
                echo "Tee-times for Royal Hawaiian Golf Club";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/royal3.jpg?v=1565999211'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 1;
                break;
            case "koolau":
                echo "Tee-times for Ko'olau Golf Club";
                echo "<style> body {background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmoNGIPL3FogIO41FRiln3Dhy0LwMdevqSEGLC5O0-ssVKfyyOEA'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 2;
                break;
            case "bayview":
                echo "Tee-times for Bayview Golf Course";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/website-2_47e4f125-a4b9-4680-a043-3bc5b02ff6cf.jpg?v=1566009408'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 3;
                break;
            case "turtle":
                echo "Tee-times for Turtle Bay Golf Resort";
                echo "<style> body {background-image:url('https://www.turtlebayresort.com/sites/default/files/KamGolfPage_BookNow_4.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 4;
                break;
            case "leilehua":
                echo "Tee-times for Leilehua Golf Club";
                echo "<style> body {background-image:url('https://millerdesigngolf.com/images/galleries/past_projects/leilehua_golf_course/Green_after_shot_8_green.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 5;
                break;
            case "koolina":
                echo "Tee-times for Ko'olina Golf Club";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/newkoolina1_7e5b8ff8-893c-42f5-accb-33d6bfab44f8.jpg?v=1566006290'); background-repeat: no-repeat; background-attachment: fixed; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 6;
                break;
            case "kapolei":
                echo "Tee-times for Kapolei Golf Course";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/newkap5.jpg?v=1566007373'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 7;
                break;
            case "alawai":
                echo "Tee-times for Ala Wai Golf Club";
                echo "<style> body {background-image:url('https://media-cdn.tripadvisor.com/media/photo-s/01/d6/7d/66/ala-wai-golf-course-from.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 8;
                break;
        }
        ?>&ensp;
    </span>

    <br><br><br><br><br>

    <?php
    
    $times = array("10:00", "10:15", "10:30", "10:45", "11:00", "11:15", "11:30", "11:45", "12:00", "12:15", "12:30", "12:45");

    try {
        $servername = "localhost";
        $username = "kedlaya";
        $password = "releasethekraken!";
        $databasename = "teeItUp";

        /* Attempt to connect to MySQL database */
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*//For checking if there are missing times
        $stmt = $conn->prepare("SELECT (`teeDateTime`) FROM `teeTime` WHERE `golfCourseID`='" . $courseID . "'");
         * */
        
        //For checking what the booked times are
        $stmt = $conn->prepare("SELECT * FROM `teeTime` WHERE `golfCourseID`='" . $courseID . "'");
        
        $stmt->execute();
        // set the resulting array to associative  
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //echo print_r($result); //Check contents of returned array form the database
         
        $bookedTimes = array(); //Declare array to store booked times 
        
        //Stores booked tee times from database into a php array to be used to determine if time buttons are active or inactive
         foreach ($result as $row) { 
             array_push($bookedTimes,$row['booked']);
         }        
         //echo "These are the booked tee times: ".print_r($bookedTimes);
         
        $timesID = array(); //Declare array to store tee time IDs
        
        //Stores tee time IDs to be used in order to update database when booked
        foreach ($result as $row) {
           array_push($timesID, $row['teeTimeID']);
        }

/*//Checks if values pulled from database matches the the vakues in the times array declared above; checks if there are missing corresponding values>
//---------------------------------------------------------------> 
//        $what = new DateTime($result[10]["teeDateTime"]);
//        $what = $what->format('H:i');
//        echo "What is an: ".gettype($what)."\n";
//        echo "What is: ".$what;      
        $formatTimes=array(); 

        foreach ($result as $row) {
            $timeString = new DateTime($row["teeDateTime"]);
            $timeString = $timeString->format('H:i');
            //Convert to readable 
            //$formatTimes[]=substr(($row['teeDateTime']->format('H:i:s')), 0, 2).":".substr(($row['teeDateTime']->format('H:i:s')), 3, 2);
            array_push($formatTimes, $timeString);
        }
        //echo sizeof($formatTimes);
        
//        echo "These are the formatted Times: ".print_r($formatTimes);
        
//        echo "\nThis is the second format time: ".$formatTimes[1];
//        echo "\nThis is the second time: ".$times[1];
//        
//        if($times[11]==$formatTimes[10])
//            echo "\nTrue or false: True";
//        else echo "\nTrue or false: False";
        
//        echo "\nThis is the size of the array times: ".sizeof($times);
//        echo "\nThis is the size of the array formatTimes: ".sizeof($formatTimes)."\n";

        $missingTimes = array();
        //Check if times are booked so can turn off corresponding button later;
        for ($i = 0; $i < sizeof($times); $i++) {
            $missingTime = 1; //Defualt- yes, it's missing
            for ($j = 0; $j < sizeof($formatTimes); $j++) {
                //If time found
                if ($times[$i] == $formatTimes[$j]) { 
                    $missingTime = 0;
                    break;
                }
            }
                array_push($missingTimes,$missingTime);
        }
        
        echo "\nThese are the missing times: ".print_r($missingTimes);

        if (empty($missingTimes)) {
            array_push($missingTimes,-1);
        }
        
        echo "\nThese are the missing times Pt 2.: ".print_r($missingTimes);
        
        echo "\nThis is the vaue at 0: ".$missingTimes[11];
 * -------------------------------------------------------------------------------------->
 */
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <table class="timeTable">
        <?php
        /* Note: Change $bookedTimes variable below to $missingTimes if changed above*/
        //Loop displays tee time buttons
        for ($x = 0; $x < sizeof($times); $x++) {

            if ($bookedTimes[$x] == 1 && $x == 0) {
                echo "<tr><td><button class='btn_off'>$times[$x]</div></td>";
            } else if ($bookedTimes[$x] != 1 && $x == 0) {
                echo"<tr><td><button class='btn' style='cursor:pointer;' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td>";
            } else if ($bookedTimes[$x] != 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button class='btn' style='cursor:pointer;' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td></tr><tr>";
            } else if ($bookedTimes[$x] == 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button class='btn_off'>$times[$x]</button></td></tr><tr>";
            } else if ($bookedTimes[$x] == 1 && $x == (count($times) - 1)) {
                echo "<td><button class='btn_off'>$times[$x]</button></td></tr>";
            } else if ($bookedTimes[$x] != 1 && $x == (count($times) - 1)) {
                echo "<td><button class='btn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td></tr>";
            } else if ($bookedTimes[$x] == 1 && $x != 0) {
                echo "<td><button class='btn_off'>$times[$x]</button></td>";
            } else
                echo "<td><button class='btn' style='cursor:pointer;' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td>";
        }
        ?>
    </table>
    <br>
    <!--<button id="book" class="bookButton" type="button" onmouseover="changeBook('white', '40px', 'seagreen', 'bold')" onclick="clickedBookButton()" onmouseout="changeBook('black', '30px', 'white', 'normal')">Book!</button>-->
    <div class="bttn" onclick="if (selectedTime !== '') {
                clickedBookButton();
            }">
                <p>Book!</p>
    </div>
</center>

<!--<script src="/Users/akbazuka/Desktop/kedlena/teeItUp/jsFiles/teeTimesJS.js"></script>-->
<script>
    
    var selectedTime = "";
    var selectedTimeID = "";

    function refreshTime(x,y)
    {
        selectedTime = x;
        selectedTimeID = y;
        console.log(selectedTime);
        console.log(selectedTimeID);
    }

    function clickedBookButton()
    {
        //alert('You booked a tee time at ' +  selectedTime + ' on 10/01/19');
        swal("Congrats!", "You booked a tee time at " + selectedTime + " on 10/01/19", "success");
        
        //Ajax method to insert into booked table in database and update tee times table
        $.ajax({
            type: "POST",
            url: "pushBookingsAjax.php",
            data: {selectedTimeID: selectedTimeID},
            success: function (data) {
                console.log(data);
            }
        });
    }

    function changeBook(x, y, z, a)
    {
        document.getElementById("book").style.color = x;
        document.getElementById("book").style.fontSize = y;
        document.getElementById("book").style.backgroundColor = z;
        document.getElementById("book").style.fontWeight = a;
    }

    //For jumping book button
    var $button = document.querySelector('.bttn');
    $button.addEventListener('click', function () {
        var duration = 0.3,
                delay = 0.08;
        TweenMax.to($button, duration, {scaleY: 1.6, ease: Expo.easeOut});
        TweenMax.to($button, duration, {scaleX: 1.2, scaleY: 1, ease: Back.easeOut, easeParams: [3], delay: delay});
        TweenMax.to($button, duration * 1.25, {scaleX: 1, scaleY: 1, ease: Back.easeOut, easeParams: [6], delay: delay * 3});
    });
</script>
<br>
</body>