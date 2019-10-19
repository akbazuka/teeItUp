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
        switch ($courseName) {
            case "royal":
                echo "Tee-times for Royal Hawaiian Golf Club";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/royal3.jpg?v=1565999211'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
            case "koolau":
                echo "Tee-times for Ko'olau Golf Club";
                echo "<style> body {background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmoNGIPL3FogIO41FRiln3Dhy0LwMdevqSEGLC5O0-ssVKfyyOEA'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
            case "bayview":
                echo "Tee-times for Bayview Golf Course";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/website-2_47e4f125-a4b9-4680-a043-3bc5b02ff6cf.jpg?v=1566009408'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
            case "turtle":
                echo "Tee-times for Turtle Bay Golf Resort";
                echo "<style> body {background-image:url('https://www.turtlebayresort.com/sites/default/files/KamGolfPage_BookNow_4.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
            case "leilehua":
                echo "Tee-times for Leilehua Golf Club";
                echo "<style> body {background-image:url('https://millerdesigngolf.com/images/galleries/past_projects/leilehua_golf_course/Green_after_shot_8_green.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
            case "koolina":
                echo "Tee-times for Ko'olina Golf Club";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/newkoolina1_7e5b8ff8-893c-42f5-accb-33d6bfab44f8.jpg?v=1566006290'); background-repeat: no-repeat; background-attachment: fixed; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
            case "kapolei":
                echo "Tee-times for Kapolei Golf Course";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/newkap5.jpg?v=1566007373'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
            case "alawai":
                echo "Tee-times for Ala Wai Golf Club";
                echo "<style> body {background-image:url('https://media-cdn.tripadvisor.com/media/photo-s/01/d6/7d/66/ala-wai-golf-course-from.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
                break;
        }
        ?>&ensp;
    </span>

    <br><br><br><br><br>

    <?php
    $times = array("10:00", "10:15", "10:30", "10:45", "11:00", "11:15", "11:30", "11:45", "12:00", "12:15", "12:30", "12:45");
    ?>
    <table class="timeTable">
        <!Have to make loop to iterate through array and display as table>
        <?php
        for ($x = 0; $x < count($times); $x++) {
            if ($x == 0) {
                echo"<tr><td><button class='btn' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td>";
            } else if ($x == (count($times) - 1)) {
                echo "<td><button class='btn' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td></tr>";
            } else if (($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button class='btn' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td></tr><tr>";
            } else
                echo "<td><button class='btn' onclick=refreshTime('" . $times[$x] . "')>$times[$x]</button></td>";
        }
        ?>
    </table>
    <br>
    <!--<button id="book" class="bookButton" type="button" onmouseover="changeBook('white', '40px', 'seagreen', 'bold')" onclick="clickedBookButton()" onmouseout="changeBook('black', '30px', 'white', 'normal')">Book!</button>-->
    <div class="bttn" onclick="clickedBookButton()">
        <p>Book!</p>
    </div>
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