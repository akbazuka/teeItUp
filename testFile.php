<?php
/*include_once "title.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
 */
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<!--<link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:400"/>-->
<link rel="stylesheet" type="text/css" href="cssFiles/teeTimesCSS.css"/>

<body>
    <br>
    <div class="user">
        &ensp;Signed in as <b><?php echo "<em>" . htmlspecialchars($_SESSION["username"]) . "</em>"; ?></b>
        <a href="logout.php" class="btn1 btn-danger" style="position: absolute; right: 30;">Sign Out</a>
    </div>
<center>
    <br>
    <br>
    <!--<span id="subtitle">&ensp;<?php
                //echo "Tee-times for Ko'olau Golf Club";
                //echo "<style> body {background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmoNGIPL3FogIO41FRiln3Dhy0LwMdevqSEGLC5O0-ssVKfyyOEA'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                $courseID = 1;
        ?><!&ensp;>
    </span>-->

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
        
        //echo print_r($result);
        
        $bookedTimes = array();
        
         foreach ($result as $row) { 
             array_push($bookedTimes,$row['booked']);
         }
         
         //echo "These are the booked tee times: ".print_r($bookedTimes);
              
/*Checks if values pulled from database matches the the vakues in the times array declared above; checks if there are missing corresponding values>*/
/*------------------------------------------------------------> 
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
        
        echo "These are the formatted Times: ".print_r($formatTimes);
        
//        echo "\nThis is the second format time: ".$formatTimes[1];
//        echo "\nThis is the second time: ".$times[1];
//        
        if($times[11]==$formatTimes[10])
            echo "\nTrue or false: True";
        else echo "\nTrue or false: False";
        
        echo "\nThis is the size of the array times: ".sizeof($times);
        echo "\nThis is the size of the array formatTimes: ".sizeof($formatTimes)."\n";

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
        <!Have to make loop to iterate through array and display as table>
        <?php
        for ($x = 0; $x < sizeof($times); $x++) {

            if ($bookedTImes[$x] == 1 && $x == 0) {
                echo "<tr><td><button class='btn_off'>$times[$x]</div></td>";
            } else if ($bookedTimes[$x] != 1 && $x == 0) {
                echo"<tr><td><button class='btn' style='cursor:pointer;' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td>";
            } else if ($bookedTimes[$x] != 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button class='btn' style='cursor:pointer;' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td></tr><tr>";
            } else if ($bookedTimes[$x] == 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button class='btn_off'>$times[$x]</button></td></tr><tr>";
            } else if ($bookedTimes[$x] == 1 && $x == (count($times) - 1)) {
                echo "<td><button class='btn_off'>$times[$x]</button></td></tr>";
            } else if ($bookedTimes[$x] != 1 && $x == (count($times) - 1)) {
                echo "<td><button class='btn' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td></tr>";
            } else if ($bookedTimes[$x] == 1 && $x != 0) {
                echo "<td><button class='btn_off'>$times[$x]</button></td>";
            } else
                echo "<td><button class='btn' style='cursor:pointer;' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td>";
        }
        ?>
    </table>
    <!--
    <br>
    <button id="book" class="bookButton" type="button" onmouseover="changeBook('white', '40px', 'seagreen', 'bold')" onclick="clickedBookButton()" onmouseout="changeBook('black', '30px', 'white', 'normal')">Book!</button>
    <div class="bttn" onclick="if (selectedTime !== '') {
                clickedBookButton();
            }">
    <p>Book!</p>
    </div>
    
    <div>
        <p style="color: black; font-size: 40px;">Hello</p>
    </div>-->
</center>

<!--<script src="/Users/akbazuka/Desktop/kedlena/teeItUp/jsFiles/teeTimesJS.js"></script>-->
<script>
    var selectedTime = "";

    function refreshTime(x)
    {
        selectedTime = x;
    }

    function clickedBookButton()
    {
        //alert('You booked a tee time at ' +  selectedTime + ' on 10/01/19');
        swal("Congrats!", "You booked a tee time at " + selectedTime + " on 10/01/19", "success");
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

