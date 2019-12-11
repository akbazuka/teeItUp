<html style="background-image: url(images/bgImg.jpg); background-size: cover;">
    <?php
    include_once "title.php";

// Initialize the session
    session_start();

// Check if the user is logged in, if not then redirect him to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    include_once 'includeMenu.php';
    ?>

    <!-- Nice alert message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Jumping button -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    
    <!--luxon for TimeZone-->
    <script src="jsFiles/addons/luxon.js"></script>
    
    <!--<link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:400"/>-->
    <link rel="stylesheet" type="text/css" href="cssFiles/teeTimesCSS.css"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!Datepicker css>
    <link href="cssFiles/addons/bootstrap-datepicker.standalone.css" rel="stylesheet">

    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="cssFiles/dropDownCSS/animate.min.css" rel="stylesheet">

    <link href="cssFiles/dropDownCSS/bootstrap-dropdownhover.min.css" rel="stylesheet">

    <body style="background: transparent;">
        <!import jQuery>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!--Bootstrap JS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Bootstrap Dropdown Hover JS -->
    <script src="jsFiles/dropDownJS/bootstrap-dropdownhover.min.js"></script>

    <!Datepicker js>
    <script src="jsFiles/addons/bootstrap-datepicker.js"></script>

    <br>

    <center>
        <br><br>
        <span id="subtitle">&ensp;<?php
            $courseName = $_GET['courseName'];
            $courseID = $_GET['courseID'];
            echo "Tee-times for " . $courseName;
//      echo "<style> body {background-image:url('https://cdn.shopify.com/s/files/1/0191/3924/products/royal3.jpg?v=1565999211'); background-repeat: no-repeat; background-attachment: scroll; background-position: 50% 116%; background-size: 800px 450px;}</style>";
            ?>&ensp;
        </span>

        <br><br><br>

        <div class="form-group">
            <!--        <label for="dueDate">Date due</label>-->
            <div class="input-group date">
                <input autocomplete="off" type="text" class="datepicker" style="border:3px solid cadetblue; border-radius: 5px;" name="dueDate" id="theDate" placeholder="Please select a date">
            </div>
        </div>

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

            /* //For checking if there are missing times
              $stmt = $conn->prepare("SELECT (`teeDateTime`) FROM `teeTime` WHERE `golfCourseID`='" . $courseID . "'");
             * */

//            //For checking what the booked times are
//            $stmt = $conn->prepare("SELECT * FROM `teeTime` WHERE `golfCourseID`='" . $courseID . "'");
//
//            $stmt->execute();
//            // set the resulting array to associative  
//            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//            //echo print_r($result); //Check contents of returned array form the database
//
//            $bookedTimes = array(); //Declare array to store booked times 
//            //Stores booked tee times from database into a php array to be used to determine if time buttons are active or inactive
//            foreach ($result as $row) {
//                array_push($bookedTimes, $row['booked']);
//            }
//            //echo "These are the booked tee times: ".print_r($bookedTimes);
//
//            $timesID = array(); //Declare array to store tee time IDs
//            //Stores tee time IDs to be used in order to update database when booked
//
//            foreach ($result as $row) {
//                array_push($timesID, $row['teeTimeID']);
//            }

            /* //Checks if values pulled from database matches the the vakues in the times array declared above; checks if there are missing corresponding values>
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
            $stmt11 = $conn->prepare("SELECT * FROM `golfCourse` WHERE `golfCourseID`='" . $courseID . "'");
            $stmt11->execute();
            // set the resulting array to associative  
            $result11 = $stmt11->fetchAll(PDO::FETCH_ASSOC);

            echo "<div class='box boxLeft'><center><b>Course Description</b></center><p><br>" . $result11[0]['courseWriteUp'] . "</p></div>";
            echo "<div class='box boxRight'><center><b>Course Information</b></center><br><p><u>Hours</u>: " . $result11[0]['courseHours'] . "<br><br><u>Phone</u>: " . $result11[0]['coursePhone'] . "<br><br><u>Location</u>: " . $result11[0]['courseLocation'] . "</p></div>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <center>
            <div id="loading" style="display:none;">
                <img id="loading" style ="width:25%;" src="https://i.giphy.com/media/dwZMxZ2VX4F3O/giphy.webp">
            </div>
        </center>
        
        <table class="timeTable" id="tt">
            <?php
            /* Note: Change $bookedTimes variable below to $missingTimes if changed above */
            //Loop displays tee time buttons
//            for ($x = 0; $x < sizeof($times); $x++) {
//
//                if ($bookedTimes[$x] == 1 && $x == 0) {
//                    echo "<tr><td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</div></td>";
//                } else if ($bookedTimes[$x] != 1 && $x == 0) {
//                    echo"<tr><td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td>";
//                } else if ($bookedTimes[$x] != 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
//                    echo "<td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td></tr><tr>";
//                } else if ($bookedTimes[$x] == 1 && ($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
//                    echo "<td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</button></td></tr><tr>";
//                } else if ($bookedTimes[$x] == 1 && $x == (count($times) - 1)) {
//                    echo "<td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</button></td></tr>";
//                } else if ($bookedTimes[$x] != 1 && $x == (count($times) - 1)) {
//                    echo "<td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td></tr>";
//                } else if ($bookedTimes[$x] == 1 && $x != 0) {
//                    echo "<td><button class='btn_off'>$times[$x]</button></td>";
//                } else
//                    echo "<td><button id='" . $times[$x] . "' class='btnOn' onclick=refreshTime('" . $times[$x] . "','" . $timesID[$x] . "')>$times[$x]</button></td>";
//            }

            for ($x = 0; $x < sizeof($times); $x++) {
                if ($x == 0) {
                    echo "<tr><td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</div></td>";
                } else if (($x + 1) % 4 == 0 && ( $x != count($times) - 1) && $x != 0) {
                    echo "<td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</button></td></tr><tr>";
                } else if ($x == (count($times) - 1)) {
                    echo "<td><button id='" . $times[$x] . "' class='btn_off'>$times[$x]</button></td></tr>";
                } else
                    echo "<td><button class='btn_off'>$times[$x]</button></td>";
            }
            ?>
        </table>
        <br><br>
        <!--<button id="book" class="bookButton" type="button" onmouseover="changeBook('white', '40px', 'seagreen', 'bold')" onclick="clickedBookButton()" onmouseout="changeBook('black', '30px', 'white', 'normal')">Book!</button>-->
        <div class="bttn" onclick="if (selectedTime !== '') {
                    clickedBookButton();
                }">
            <p>Book!</p>
        </div>
        <br><br>
    </center>

<!--<script src="/Users/akbazuka/Desktop/kedlena/teeItUp/jsFiles/teeTimesJS.js"></script>-->
    
    <script>

        //To validate tee time buttons; check if time has been passed already
        //var hawaiiTimeZone = new Date().toLocaleString("en-US", {timezone: "America/Hawaii"});
        var hawaiiTimeZone = luxon.DateTime.local().setZone('UTC+10');
        //hawaiiTimeZone = new Date(hawaiiTimeZone);
        console.log("This is Hawaiian Time: "+hawaiiTimeZone.toString());

        //Create date picker object
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            startDate: '0d',
            endDate: '+6d',
            language: "en",
            autoclose: true
        });

        var selectedTime = "";
        var selectedDate = "";
        var selectedTimeID = ""; //Takes care of time and date
        var selectedGolfCourseID = <?php echo $courseID; ?>; //Get golf course ID from php
        //console.log("Selected golf course ID: "+selectedGolfCourseID);

        function refreshTime(x, y)
        {
            selectedTime = x;
            selectedTimeID = y;
//            console.log(selectedTime);
//            console.log(selectedTimeID);
        }

        $(".datepicker").on('change', function (event) {
            event.preventDefault();
            //alert(this.value);
            selectedDate = this.value;
            //alert(selectedDate);
            getTimes(refreshDate); //Callback to refreshDate with getTimes
            //refreshDate();
        });

        function getTimes(callback) {
            $.ajax({
                type: "POST",
                url: "getTeeTimes.php",
                data: {selectedDate: selectedDate, selectedGolfCourseID: selectedGolfCourseID},
                success: function (result)
                {
                    //console.log(result);
                    $('#tt').html(result);
                }
            });
            setTimeout(function () {
                callback();
            }, 500); //Call function after a 300 milliseconds of time to give ajax time to process result; get tee proper times for refreshDate()
        }

        function refreshDate() {
            //console.log("The selected date is: " + selectedDate);

            //Save elements of class and length in Variables to be used in for loop
            var count = $('.btnOn').length;
            var classArray = $('.btnOn');
            //console.log(classArray);

            dateYear = selectedDate.split("-")[0];
            dateMonth = selectedDate.split("-")[1];
//            console.log("Date Month: "+dateMonth); //Current month shows correctly
            dateDay = selectedDate.split("-")[2];

            for (var i = 0; i < count; i++) {
                //console.log(count);
                //console.log("This is i: " + i);
                //console.log($('.btnOn').length); //check no of items left in array
                //console.log("These are the elements: " + classArray[i].id);
                buttonHour = classArray[i].id.split(":")[0];
                buttonMinute = classArray[i].id.split(":")[1];

                buttonTime = new Date(dateYear, (dateMonth - 1), dateDay, buttonHour, buttonMinute); //For some reason, date month appears as next month after the current so had to do (month-1)
                //console.log(buttonTime.toLocaleString());
                //console.log(hawaiiTimeZone.toLocaleString());

//             console.log(buttonTime.toLocaleString());
                //console.log(testTime.toLocaleString());

//                testTime = new Date(2019, 10, 24, 14, 16);
//                if (buttonTime <= testTime) {

                relevantButton = classArray[i].id;
                //console.log("This is the relavant button: "+relevantButton);

                //console.log(document.getElementById(relevantButton));
                thisID = document.getElementById(relevantButton);

                if (buttonTime.valueOf() <= hawaiiTimeZone.valueOf()) { //Check if current time is Hawaii is past tee time and turn button off if so
                    //console.log("True");

                    //console.log("This is the time selected: "+$('.btnOn').get(i).id);
                    //console.log("This is the current time: "+hawaiiTimeZone);

                    thisID.classList.remove("btnOn");
                    thisID.classList.add("btn_off");
                    //thisID.setAttribute("onclick", ""); removes onclick event for button but apparently is not needed here
//                $('#10:15').addClass('btnOff').removeClass('btnOn'); //not working for some reason 
                } else if (buttonTime > hawaiiTimeZone && thisID.classList.contains("btn_off")) {
                    //console.log("False");
                    thisID.classList.remove("btn_off");
                    thisID.classList.add("btnOn");
                }
            }
        }

        //console.log($('.btnOn').get(0).id);

        //Event Listener to reset selectedTime to empty when user clicks anywhere outside a tee time button
        document.addEventListener(`click`, function (event) {
            //Runs only when class is NOT 'btnOn'
            if (!event.target.closest('.btnOn')) {
                refreshTime('', '');
            }
        });


        function showLoading() {
            //Show loading image
            $("#loading").show();

            //After specified amount of time (milliseconds), hide loading image
            setTimeout(function () {
                $('#loading').hide();
            }, 7000);

            //After specified amount of time (milliseconds), show ajax results 
            setTimeout(function () {
                $('#tt').show();
            }, 7000);
        }

        function clickedBookButton()
        {
            //Cursor indicates that something is loading
            $("#loading").css("cursor", "wait");

            //Hide tee times
            $("#tt").hide();
            
            showLoading();

            //Don't allow click anywhere on screen
            //$("body").children().bind('click', function(){ return false; }); Not working

            //Ajax method to insert into booked table in database and update tee times table
            $.ajax({
                type: "POST",
                url: "pushBookingsAjax.php",
                data: {selectedTimeID: selectedTimeID},
                success: function (data) {
                    //console.log(data); 

                    //Cursor back to default after ajax request loads
                    $("#loading").css("cursor", "default");

                    //Allow click on screen again
                    //$("html").children().unbind('click'); Bind not working above

                    Swal.fire({
                        icon: 'success',
                        title: 'Congrats!',
                        text: 'Your booking was successful!',
                        allowOutsideClick: false
                    });
                    $(Swal.getConfirmButton()).click(function () {
                        window.location.replace("viewBookings.php"); //Automatically navigate to view bookings page when okay button is clicked
                    });
                }
            });

            //Ajax request to send SMS confirmation to user
            $.ajax({
                type: "POST",
                url: "getSMS.php",
                data: {selectedTimeID: selectedTimeID},
                success: function (data1) {
                    var obj = JSON.parse(data1); //Convert JSON data to javascript object
                    //console.log(obj);
                    //console.log("This is data 1: " + data1);
                    var phoneNotify = obj.phoneNotify;
                    //console.log("This is the notification preference: " + phoneNotify);
                    var phone = obj.phone;
                    //console.log("This is the phone no: " + phone);
                    var time = obj.time;
                    var date = obj.date;
                    var golfCourseName = obj.golfCourseName;
                    var message = "Congratulations on booking a tee time for " + time + " on " + date + " at " + golfCourseName + ". To manage booking, please log into your account at Tee It Up!";
                    //var message1 = "To view or manage your booking, please log in to your account at www.kedlena.com/teeItUp.\n -Tee It Up! Team";
                    if (phoneNotify == 1) {
                        //The below link sends text message. replace with own php file if using own server in future
                        $.ajax({
                            url: "https://www.italoha.com/csci3632/precious.binas/requests/sendTextMessage.php?cell=" + phone + "&message=" + message,
                            success: function (result)
                            {
                                //console.log("This is the result of sending text: " + result);
                            }
                        });
                        //Send message1 as separate message
//                        $.ajax({
//                            url: "https://www.italoha.com/csci3632/precious.binas/requests/sendTextMessage.php?cell=" + phone + "&message=" + message1,
//                            success: function (result1)
//                            {
//                                //console.log("This is the result of sending text: " + result);
//                            }
//                        });
                    }
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
            var duration = 0.3, delay = 0.08;
            TweenMax.to($button, duration, {scaleY: 1.6, ease: Expo.easeOut});
            TweenMax.to($button, duration, {scaleX: 1.2, scaleY: 1, ease: Back.easeOut, easeParams: [3], delay: delay});
            TweenMax.to($button, duration * 1.25, {scaleX: 1, scaleY: 1, ease: Back.easeOut, easeParams: [6], delay: delay * 3});
        });
    </script>
    <br>
</body>