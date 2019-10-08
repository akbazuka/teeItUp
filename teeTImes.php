<?php include_once "title.php"; ?>

<style>
    #subtitle
    {
        color:white;
        background-color:seagreen;
        border: 3px solid white;
        border-radius: 10px;
        font-size: 40px;
        padding:1%;
        /*text-decoration: underline;
        text-decoration-color: white;*/

    }
    .timeTable
    {
        width: 50%;
        color: white;
        text-align: center;
        border-spacing: 20px;
    }
    .btn
    {
        border: 3px solid white;
        color:white;
        background-color: black;
        border-radius: 10px;
        padding: 17%;  
        font-size: 20px;
        font-weight: bold;
    }
    .btn:hover
    {
        color:black;
        background-color:white;  
        border: 3px solid seagreen;

    }
    
    .btn:focus-within
    {
       color:black;
       background-color:white;  
       border: 3px solid seagreen;
    }
    
    .bookButton
    {
        color: black;
        background-color: white;
        border: 3px solid black;
        width: 15%;
        height: 7%;
        border-radius: 10px;
        font-size: 30px;
    }
</style>

<body>
<center>
    <br>
    <br>
    <br>
    <span id="subtitle">&ensp;<?php
        $courseName = $_GET['courseName'];
        switch ($courseName) {
            case "royal":
                echo "Tee-times for Royal Hawaiian Golf Club";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/royal3.jpg?v=1565999211'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 90%; background-size: 800px 450px;}</style>";
                break;
            case "koolau":
                echo "Tee-times for Ko'olau Golf Club";
                echo "<style> body {background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmoNGIPL3FogIO41FRiln3Dhy0LwMdevqSEGLC5O0-ssVKfyyOEA'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 90%; background-size: 800px 450px;}</style>";
                break;
            case "bayview":
                echo "Tee-times for Bayview Golf Course";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/website-2_47e4f125-a4b9-4680-a043-3bc5b02ff6cf.jpg?v=1566009408'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 90%; background-size: 800px 450px;}</style>";
                break;
            case "turtle":
                echo "Tee-times for Turtle Bay Golf Resort";
                echo "<style> body {background-image:url('https://www.turtlebayresort.com/sites/default/files/KamGolfPage_BookNow_4.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 90%; background-size: 800px 450px;}</style>";
                break;
            case "leilehua":
                echo "Tee-times for Leilehua Golf Club";
                echo "<style> body {background-image:url('https://millerdesigngolf.com/images/galleries/past_projects/leilehua_golf_course/Green_after_shot_8_green.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 90%; background-size: 800px 450px;}</style>";
                break;
            case "koolina":
                echo "Tee-times for Ko'olina Golf Club";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/newkoolina1_7e5b8ff8-893c-42f5-accb-33d6bfab44f8.jpg?v=1566006290'); background-repeat: no-repeat; background-attachment: fixed; background-position: 50% 90%; background-size: 800px 450px;}</style>";
                break;
            case "kapolei":
                echo "Tee-times for Kapolei Golf Course";
                echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/newkap5.jpg?v=1566007373'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 90%; background-size: 800px 450px;}</style>";
                break;
            case "alawai":
                echo "Tee-times for Ala Wai Golf Club";
                echo "<style> body {background-image:url('https://www.honolulu.gov/rep/site/des/golf_imgs/Ala_Wai_Golf_Course.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 90%; background-size: 800px 450px;}</style>";
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
                echo"<tr><td><button class='btn'>$times[$x]</button></td>";
            } else if ($x == (count($times) - 1)) {
                echo "<td><button class='btn'>$times[$x]</button></td></tr>";
            } else if (($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                echo "<td><button class='btn'>$times[$x]</button></td></tr><tr>";
            } else
                echo "<td><button class='btn'>$times[$x]</button></td>";
        }
        ?>
    </table>
    <br>
    <button id="book" class="bookButton" type="button" onclick="clickedBookButton()" onmouseover="changeBook('white', '40px', 'seagreen', 'normal')" onmouseout="changeBook('black', '30px', 'white', 'normal')">Book!</button>
</center>

<script>

    function clickedBookButton()
    {
        alert('You booked a tee time at 10:30 am on 10/01/19');
    }

    function changeBook(x, y, z, a)
    {
        document.getElementById("book").style.color = x;
        document.getElementById("book").style.fontSize = y;
        document.getElementById("book").style.backgroundColor = z;
        document.getElementById("book").style.fontWeight = a;
    }
</script>
</body>