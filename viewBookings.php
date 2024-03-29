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
    <link href='https://fonts.googleapis.com/css?family=Charm' rel='stylesheet'>

    <!Import Bootstrap>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="cssFiles/viewBookingsCSS.css"/>

    <link rel="stylesheet" type="text/css" href="cssFiles/addons/datatables.min.css"/>

    <link rel="stylesheet" type="text/css" href="cssFiles/addons/datatables-select.min.css"/>

    <!-- Bootstrap Dropdown Hover CSS -->
    <link href="cssFiles/dropDownCSS/animate.min.css" rel="stylesheet">

    <link href="cssFiles/dropDownCSS/bootstrap-dropdownhover.min.css" rel="stylesheet">

    <body style="background-color: transparent;">
        <br>
        <br>
        <?php
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

            //For checking what the booked times are
            $stmt2 = $conn->prepare("SELECT * FROM `bookings` WHERE `userID`='" . $_SESSION["id"] . "' ORDER BY `teeTimeID`");
            $stmt2->execute();

            // set the resulting array to associative  
            $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
//
//    echo print_r($result2);
//    echo "\n" . $result2[1]['teeTimeID'];
            //To store the booked date times
            $bookingIDs = array();
            $teeTimes = array();
            $teeDates = array();
            //To store the booked golf course IDs   
            $golfCourseIDs = array();

            foreach ($result2 as $row) {
                //Get booking IDs
                $bookingID = $row['bookingID'];
                array_push($bookingIDs, $bookingID);

                //Get tee date and times for tee time IDs
                $stmt3 = $conn->prepare("SELECT `teeDateTime` FROM `teeTime` WHERE `teeTimeID`='" . $row['teeTimeID'] . "'");
                $stmt3->execute();
                $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                //Convert to proper format date and time and push to separate arrays
                $dates_times = (explode(" ", date('Y-m-d H:i', strtotime($result3[0]['teeDateTime']))));
                $times = $dates_times[1];
                $dates = $dates_times[0];
                array_push($teeTimes, $times);
                array_push($teeDates, $dates);

                //Get golf course IDs for tee time IDs
                $stmt4 = $conn->prepare("SELECT `golfCourseID` FROM `teeTime` WHERE `teeTimeID`='" . $row['teeTimeID'] . "'");
                $stmt4->execute();
                $result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                //Convert to proper format date and time and push to array
                array_push($golfCourseIDs, $result4[0]['golfCourseID']);
            }

//    echo "\n These are the tee times: " . print_r($teeTimes);
//    echo "\n These are the tee dates: " . print_r($teeDates);
//    echo "\n These are the golf course IDs: " . print_r($golfCourseIDs);
            //To store the booked golf course names
            $golfCourseNames = array();

            foreach ($golfCourseIDs as $row) {
                //Get golf course names for tee times
                $stmt5 = $conn->prepare("SELECT `golfCourseName` FROM `golfCourse` WHERE `golfCourseID`='" . $row['golfCourseID'] . "'");
                $stmt5->execute();
                $result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
                //Convert to proper format date and time and push to array
                array_push($golfCourseNames, $result5[0]['golfCourseName']);
            }

            //echo "\n These are the golf course names: " . print_r($golfCourseNames);

            /* Display information from database in table */
            echo "<div class='outer'><div class='middle'><div class='inner'><table id='dtBasicExample' class='table table-striped table-bordered table-sm' cellspacing='0' width='100%'>
  <thead>
    <tr>
    <th class='th-sm'>Ref. No.
      </th>
      <th class='th-sm'>Date
      </th>
      <th class='th-sm'>Time
      </th>
      <th class='th-sm'>Course
      </th>
      <th class='th-sm'>Manage
      </th>
    </tr>
  </thead>";

            for ($i = 0; $i < sizeof($teeDates); $i++) {
                echo "
    <tr>
      <td>" . $bookingIDs[$i] . "</td>
      <td>" . $teeDates[$i] . "</td>
      <td>" . $teeTimes[$i] . "</td>
      <td>" . $golfCourseNames[$i] . "</td>
      <td><button class='btn1-delete' onclick= cancelBooking(" . $bookingIDs[$i] . ")>Delete</button></td>
    </tr>";
            }

            echo "</table></div></div></div><br><br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        <!-- jQuery library --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="jsFiles/addons/datatables.min.js"></script>
        <script src="jsFiles/addons/datatables-select.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

        <!-- Bootstrap Dropdown Hover JS -->
        <script src="jsFiles/dropDownJS/bootstrap-dropdownhover.min.js"></script>

<!--<script src="jsFiles/vendor/modernizr-3.7.1.min.js"></script>-->

        <script>
            // Search in dataTable
            $(document).ready(function () {
                $('#dtBasicExample').DataTable({
                    "searching": true, // false to disable search (or any other option)
                    "scrollY": "25em",
                    "scrollCollapse": true
                });
                $('.dataTables_length').addClass('bs-select');
            });

            function cancelBooking(x)
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        //Ajax method to insert into booked table in database and update tee times table
                        $.ajax({
                            type: "POST",
                            url: "deleteBookingsAjax.php",
                            data: {bookingID: (x)},
                            success: function (data) {
//                                console.log(data);
                            }
                        });
                        Swal.fire(
                                'Deleted!',
                                'Your booking has been deleted.',
                                'success'
                                );
                        $(Swal.getConfirmButton()).click(function () {
                            document.location.reload(true); //Reload document when ok button is clicked
                        });
                    }
                });
            }
        </script>
    </body>
</html>