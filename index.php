<?php
//Include title
include_once 'title.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<head> 
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
    <link rel="stylesheet" type="text/css" href="cssFiles/indexCSS.css">
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <br>
    <div class="user">
        &ensp;Welcome, <b><?php echo "<em>" . htmlspecialchars($_SESSION["username"]) . "</em>"; ?></b> 
        <a href="viewBookings.php" class="btn-bookings" style="position: absolute; left: 300; top: 228;">View My Bookings</a>
        <a href="logout.php" class="btn btn-danger" style="position: absolute; right: 30; top: 228;">Sign Out</a>
        <a href="reset-password.php" class="btn btn-warning" style="position: absolute; right: 120; top: 228;">Reset My Password</a>
    </div>
<center>

    <?php
    try {
        $servername = "localhost";
        $username = "kedlaya";
        $password = "releasethekraken!";
        $databasename = "teeItUp";
        
        /* Attempt to connect to MySQL database */
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM `golfCourse`");
        $stmt->execute();
        // set the resulting array to associative  
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $j = 1;
        
        foreach ($result as $row) {
            
            echo "<div class='box' id='box".$j."'>
        <a class='courses' target='_self' href='teeTimes.php?courseName=".$row['htmlIDName']."' onmouseover='boxHover(\"box".$j."\", \"crimson\")' onmouseout='boxHover(\"box".$j."\", \"green\")'>
            <img src='" . $row['courseImageLink'] . "'>
            <div class='desc'>" . $row['golfCourseName'] . "</div>
        </a>
        <div class='popup topright' onclick='popUp(\"".$row['htmlIDName']."\")'>i
            <span class='popuptext' id='".$row['htmlIDName']."'>Hours: ".$row['courseHours']."<br>Phone: ".$row['coursePhone']."</span>
        </div>
    </div>";
            $j++;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <!--    
        <div class="box" id="box1">
            <a class="courses" target="_self" href="teeTimes.php?courseName=royal" onmouseover="boxHover('box1', 'crimson')" onmouseout="boxHover('box1', 'green')">
                <img src="https://cdn.shopify.com/s/files/1/0191/3924/products/royal3.jpg?v=1565999211" alt="Royal Hawaiian Golf Club">
                <div class="desc">Royal Hawaiian Golf Club</div>
            </a>
            <div class="popup topright" onclick="popUp('infoRoyal')">i
                <span class="popuptext" id="infoRoyal">Hours: Mon-Sun; 6am-6pm<br>Phone: (808) 262-2139</span>
            </div>
        </div>-->
    <!--
        <div class="box" id="box2">
            <a class="courses" target="_self" href="teeTimes.php?courseName=koolau" onmouseover="boxHover('box2', 'crimson')" onmouseout="boxHover('box2', 'green')">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmoNGIPL3FogIO41FRiln3Dhy0LwMdevqSEGLC5O0-ssVKfyyOEA" alt="Ko'olau Golf Club">
                <div class="desc">Ko'olau Golf Club</div>
            </a>
            <div class="popup topright" onclick="popUp('infoKoolao')">i
                <span class="popuptext" id="infoKoolao">Hours: Mon-Sun; 6:30am-6pm<br>Phone: (808) 236-4653</span>
            </div>
        </div>
    
        <div class="box" id="box3">
            <a class="courses" target="_self" href="teeTimes.php?courseName=bayview" onmouseover="boxHover('box3', 'crimson')" onmouseout="boxHover('box3', 'green')">
                <img src="https://cdn.shopify.com/s/files/1/0191/3924/products/website-2_47e4f125-a4b9-4680-a043-3bc5b02ff6cf.jpg?v=1566009408" alt="Bayview Golf Course">
                <div class="desc">Bayview Golf Course</div>
            </a>
            <div class="popup topright" onclick="popUp('infoBayview')">i
                <span class="popuptext" id="infoBayview">Hours: Mon-Sun; 6:30am-9pm<br>Phone: (808) 247-0451</span>
            </div>
        </div>
    
        <div class="box" id="box4">
            <a class="courses" target="_self" href="teeTimes.php?courseName=turtle" onmouseover="boxHover('box4', 'crimson')" onmouseout="boxHover('box4', 'green')">
                <img src="https://www.turtlebayresort.com/sites/default/files/KamGolfPage_BookNow_4.jpg" alt="Turtle Bay Golf Resort">
                <div class="desc">Turtle Bay Golf Resort</div>
            </a>
            <div class="popup topright" onclick="popUp('infoTurtle')">i
                <span class="popuptext" id="infoTurtle">Hours: Mon-Sun; 6:30am-6pm<br>Phone: (808) 247-0451</span>
            </div>
        </div>
    
        <div class="box" id="box5">
            <a class="courses" target="_self" href="teeTimes.php?courseName=leilehua" onmouseover="boxHover('box5', 'crimson')" onmouseout="boxHover('box5', 'green')">
                <img src="https://millerdesigngolf.com/images/galleries/past_projects/leilehua_golf_course/Green_after_shot_8_green.jpg" alt="Leilehua Golf Club">
                <div class="desc">Leilehua Golf Club</div>
            </a>
            <div class="popup topright" onclick="popUp('infoLeilehua')">i
                <span class="popuptext" id="infoLeilehua">Hours: Mon-Sun; 6:30am-7:30pm<br>Phone: (808) 655-4653</span>
            </div>
        </div>
    
        <div class="box" id="box6">
            <a class="courses" target="_self" href="teeTimes.php?courseName=koolina" onmouseover="boxHover('box6', 'crimson')" onmouseout="boxHover('box6', 'green')">
                <img src="https://cdn.shopify.com/s/files/1/0191/3924/products/newkoolina1_7e5b8ff8-893c-42f5-accb-33d6bfab44f8.jpg?v=1566006290" alt="Ko'olina Golf Club">
                <div class="desc">Ko'olina Golf Club</div>
            </a>
            <div class="popup topright" onclick="popUp('infoKoolina')">i
                <span class="popuptext" id="infoKoolina">Hours: Mon-Sun; 6:30am-7pm<br>Phone: (808) 676-5300</span>
            </div>
        </div>
    
        <div class="box" id="box7">
            <a class="courses" target="_self" href="teeTimes.php?courseName=kapolei" onmouseover="boxHover('box7', 'crimson')" onmouseout="boxHover('box7', 'green')">
                <img src="https://cdn.shopify.com/s/files/1/0191/3924/products/newkap5.jpg?v=1566007373" alt="Kapolei Golf Course">
                <div class="desc">Kapolei Golf Course</div>
            </a>
            <div class="popup topright" onclick="popUp('infoKapolei')">i
                <span class="popuptext" id="infoKapolei">Hours: Mon-Sun; 6am-6pm<br>Phone: (808) 674-2227</span>
            </div>
        </div>
    
        <div class="box" id="box8">
            <a class="courses" target="_self" href="teeTimes.php?courseName=alawai" onmouseover="boxHover('box8', 'crimson')" onmouseout="boxHover('box8', 'green')">
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/01/d6/7d/66/ala-wai-golf-course-from.jpg" alt="Ala Wai Golf Club">
                <div class="desc">Ala Wai Golf Club</div>
            </a>
            <div class="popup topright" onclick="popUp('infoAlawai')">i
                <span class="popuptext" id="infoAlawai">Hours: Mon-Sun; 6am-5:30pm<br>Phone: (808) 733-7387</span>
            </div>
        </div>-->
</center>
<!--<script src="/Users/akbazuka/Desktop/kedlena/teeItUp/jsFiles/indexJS.js"></script>-->
<script>
//Event Listener to remove popups when clicking anywhere but info button
    document.addEventListener(`click`, function (event) {
        //Runs only when class is NOT 'popup'
        if (!event.target.closest('.popup')) {
            var showItems = document.getElementsByClassName("popuptext");
            for (i = 0; i < showItems.length; i++)
            {
                //Removes previous CSS 'active' class every time new item is clicked
                showItems[i].classList.remove("show");
            }
        }
    });

//Changes color of golf course container borders when hovering over link   
    function boxHover(n, x) {
        document.getElementById(n).style.borderColor = x;
    }

//When the user clicks on div, open the popup
    function popUp(x) {
        //alert("sent");
        var popup = document.getElementById(x);
        console.log(popup);
        var showItems = document.getElementsByClassName("popuptext");
        for (i = 0; i < showItems.length; i++)
        {
            //Removes previous CSS 'active' class every time new item is clicked
            showItems[i].classList.remove("show");
        }
        popup.classList.add("show");
    }
</script>
</body>
</html>



