<?php include_once 'title.php'; ?>

<head> 
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

    </style>
</head>

<body>
    <br>
    <br>
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
            <img src="https://www.honolulu.gov/rep/site/des/golf_imgs/Ala_Wai_Golf_Course.jpg" alt="Ala Wai Golf Club">
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

