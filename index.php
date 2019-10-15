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
    <style>
        html
        {
            /*text-align:center;*/
            background-color:black;
        }
        .box 
        {
            margin-left: 5%;
            margin-right: 1%;
            margin-top: 3%;
            margin-bottom: 3%;
            height: 17%;
            border: 5px solid green;
            float:left;
            width: 15%;
            padding: 4% 15px;
            border-radius: 25px;
            background-color: white;
            position:relative;
        }  

        .box img
        {
            width: 100%;
            height: auto;
        }
        a.courses
        {
            color:seagreen;
            font-weight: bold;
        }
        a.courses:visited 
        {
            color:seagreen;
        }            
        a.courses:hover
        {
            color:crimson !important;
            border-color:crimson;
        }
        div.desc 
        {
            padding: 15px;
            text-align: center;
        }
        /* Popup container - can be anything you want */
        .popup 
        {
            position: relative;
            display: inline-block;
            border: 2px solid black;
            border-radius: 100px;
            padding: 2%;
            color: black;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* The actual popup */
        .popup .popuptext 
        {
            visibility:hidden;
            width: 260px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after 
        {
            content: "";
            position: absolute;
            top: 100%;
            left: 31%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Toggle this class - hide and show the popup */
        .popup .show 
        {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s;
        }

        .topright 
        {
            position: absolute;
            top: 8px;
            right: 16px;
            font-size: 18px;
        }

        /*Add animation (fade in the popup)*/
        @-webkit-keyframes fadeIn 
        {
            from {opacity: 0;} 
            to {opacity: 1;}
        }

        @keyframes fadeIn 
        {
            from {opacity: 0;}
            to {opacity:1 ;}
        }

        div.user
        {
            color: white;
            font-size: 250%;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid white;
            border-radius: 4px;
        }

        .btn-danger {
            color: #fff;
            background-color: #d9534f;
            border-color: white;
        }
        .btn-danger:focus,
        .btn-danger.focus {
            color: #fff;
            background-color: #c9302c;
            border-color: white;
        }
        .btn-danger:hover {
            color: #fff;
            background-color: #c9302c;
            border-color: whitesmoke;
            border-width: 2px;
        }

        .btn-danger:active,
        .btn-danger.active,
        .open > .dropdown-toggle.btn-danger {
            color: #fff;
            background-color: #c9302c;
            border-color: whitesmoke;
        }

        .btn-danger:active:hover,
        .btn-danger.active:hover,
        .open > .dropdown-toggle.btn-danger:hover,
        .btn-danger:active:focus,
        .btn-danger.active:focus,
        .open > .dropdown-toggle.btn-danger:focus,
        .btn-danger:active.focus,
        .btn-danger.active.focus,
        .open > .dropdown-toggle.btn-danger.focus {
            color: #fff;
            background-color: #ac2925;
            border-color: whitesmoke;
        }

        .btn-danger:active,
        .btn-danger.active,
        .open > .dropdown-toggle.btn-danger {
            background-image: none;
        }

        .btn-danger.disabled:hover,
        .btn-danger[disabled]:hover,
        fieldset[disabled] .btn-danger:hover,
        .btn-danger.disabled:focus,
        .btn-danger[disabled]:focus,
        fieldset[disabled] .btn-danger:focus,
        .btn-danger.disabled.focus,
        .btn-danger[disabled].focus,
        fieldset[disabled] .btn-danger.focus {
            background-color: #d9534f;
            border-color: white;
        }

        .btn-danger .badge {
            color: #d9534f;
            background-color: #fff;
        }

        .btn-warning {
            color: #fff;
            background-color: #f0ad4e;
            border-color: white;
        }
        
        .btn-warning:focus,
        .btn-warning.focus {
            color: #fff;
            background-color: #ec971f;
            border-color: white;
        }
        
        .btn-warning:hover {
            color: #fff;
            background-color: #ec971f;
            border-color: white;
            border-width: 2px;
        }
        
        .btn-warning:active,
        .btn-warning.active,
        .open > .dropdown-toggle.btn-warning {
            color: #fff;
            background-color: #ec971f;
            border-color: white;
        }
        
        .btn-warning:active:hover,
        .btn-warning.active:hover,
        .open > .dropdown-toggle.btn-warning:hover,
        .btn-warning:active:focus,
        .btn-warning.active:focus,
        .open > .dropdown-toggle.btn-warning:focus,
        .btn-warning:active.focus,
        .btn-warning.active.focus,
        .open > .dropdown-toggle.btn-warning.focus {
            color: #fff;
            background-color: #d58512;
            border-color: white;
        }
        
        .btn-warning:active,
        .btn-warning.active,
        .open > .dropdown-toggle.btn-warning {
            background-image: none;
        }
        
        .btn-warning.disabled:hover,
        .btn-warning[disabled]:hover,
        fieldset[disabled] .btn-warning:hover,
        .btn-warning.disabled:focus,
        .btn-warning[disabled]:focus,
        fieldset[disabled] .btn-warning:focus,
        .btn-warning.disabled.focus,
        .btn-warning[disabled].focus,
        fieldset[disabled] .btn-warning.focus {
            background-color: #f0ad4e;
            border-color: white;
        }
        
        .btn-warning .badge {
            color: #f0ad4e;
            background-color: #fff;
        }

    </style>
</head>

<body>
    <br>
    <div class="user">
        &ensp;Welcome, <b><?php echo "<em>" . htmlspecialchars($_SESSION["username"]) . "</em>"; ?></b>
        <a href="logout.php" class="btn btn-danger" style="position: absolute; right: 30;">Sign Out</a>
        <a href="reset-password.php" class="btn btn-warning" style="position: absolute; right: 120;">Reset Your Password</a>
    </div>
<center>
    <div class="box" id="box1">
        <a class="courses" target="_self" href="teeTimes.php?courseName=royal" onmouseover="boxHover('box1', 'crimson')" onmouseout="boxHover('box1', 'green')">
            <img src="https://cdn.shopify.com/s/files/1/0191/3924/products/royal3.jpg?v=1565999211" alt="Royal Hawaiian Golf Club">
            <div class="desc">Royal Hawaiian Golf Club</div>
        </a>
        <div class="popup topright" onclick="popUp('infoRoyal')">i
            <span class="popuptext" id="infoRoyal">Hours: Mon-Sun; 6am-6pm<br>Phone: (808) 262-2139</span>
        </div>
    </div>

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
    </div>
</center>

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
        var popup = document.getElementById(x);
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



