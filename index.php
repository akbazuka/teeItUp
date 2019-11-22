<html style="background-image: url(images/bgImg.jpg); background-size: cover;">
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
include_once 'includeMenu.php'; 
?>

<head> 
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
    <link rel="stylesheet" type="text/css" href="cssFiles/indexCSS.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="cssFiles/dropDownCSS/animate.min.css" rel="stylesheet">
    
    <link href="cssFiles/dropDownCSS/bootstrap-dropdownhover.min.css" rel="stylesheet">
</head>

<body style="background-color: transparent; line-height: 1;">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!--Bootstrap JS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="jsFiles/dropDownJS/bootstrap-dropdownhover.min.js"></script>

    <br><br>
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
        
        echo "<div class='container1'>";
        
        foreach ($result as $row) {

            echo "<div class='box' id='box" . $j . "'>
        <a class='courses' target='_self' href='teeTimes.php?courseName=" . $row['golfCourseName'] . "&courseID=" . $row['golfCourseID'] . "' onmouseover='boxHover(\"box" . $j . "\", \"seagreen\", \"5px\"); boxHover(\"pop" . $j . "\", \"seagreen\", \"2px\");' onmouseout='boxHover(\"box" . $j . "\", \"black\", \"3px\"); boxHover(\"pop" . $j . "\", \"black\", \"2px\");'>
            <img src='" . $row['courseImageLink'] . "' style='width: 100%; height: auto;'>
            <div class='desc'>" . $row['golfCourseName'] . "</div>
        </a>
        <div id='pop" . $j . "' class='popup topright' onclick='popUp(\"" . $row['golfCourseID'] . "\")'>i
            <span class='popuptext' id='" . $row['golfCourseID'] . "'>Hours: " . $row['courseHours'] . "<br>Phone: " . $row['coursePhone'] . "</span>
        </div>
    </div>";
            $j++;
        }
        echo "</div>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
   
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
    function boxHover(n, x, y) {
        document.getElementById(n).style.borderColor = x;
        document.getElementById(n).style.color = x;
        document.getElementById(n).style.borderWidth = y;    
    }

//When the user clicks on div, open the popup
    function popUp(x) {
        //alert("sent");
        var popup = document.getElementById(x);
//        console.log(popup);
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



