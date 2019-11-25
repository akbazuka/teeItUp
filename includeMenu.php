<?php
require_once "config.php";

//Get user's emailNotification Preference
$sql = "SELECT `emailNotification` FROM `users` WHERE `id`=" . $_SESSION['id'];
$result = $link->query($sql);

while ($row = $result->fetch_assoc()) {
    $emailNotify = $row["emailNotification"];
}
?>

<link href="cssFiles/menuCSS.css" rel="stylesheet"> 
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<body>

    <div class="menu">
        <a class="btn1 btn1-bookings" href="index.php" style="position: absolute; left: 30;"><img src="images/homeIcon.png"></a> 
        <a href="viewBookings.php" class="btn1-bookings" style="position: absolute; left: 130;"><img src="images/eventIcon.png">&ensp;My Bookings</a>
        <!--        <a href="reset-password.php" class="btn btn-warning" style="position: absolute; right: 120; top: 228;">Reset My Password</a>-->

        <div class="dropdown pull-right" style="cursor:pointer; position: absolute; right: 30;">
        <!--<li class=" style btn btn-home" style="position: absolute; right: 30; display:inline-block; vertical-align:middle;"><a href='#calendar'><img src="images/icon.png" style="bottom:50px;">                <b><?php echo "<em style='font-size:22px;'>" . htmlspecialchars($_SESSION["username"]) . "</em>"; ?></b><i class='fa fa-caret-down'></i></a>-->
            <button class="btn1-bookings dropdown-toggle" type="button" data-hover="dropdown">
                <img src="images/accountIcon.png" style="bottom:50px;">&ensp;<b>
                    <?php echo "<span style='font-size:22px; font-weight:normal;'>" . htmlspecialchars($_SESSION["username"]) . "</span>"; ?>
                </b>&ensp;
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" style="min-width: 230px;">
                <li><a href="reset-password.php">Change Password</a></li>
                <li class="divider"></li>
                <li><a>Email Confirmation&ensp;&ensp;&ensp;&ensp;<input id="toggle-demo" type="checkbox" data-toggle="toggle" data-size="mini"></a></li>
                <li><a href="resetEmail.php">Change Email</a></li>
                <li class="divider"></li>
                <li><a>SMS Confirmation&ensp;&ensp;&ensp;&ensp;<input id="toggle-demo1" type="checkbox" data-toggle="toggle" data-size="mini"></a></li>
                <li><a href="resetPhone.php">Change Phone Number</a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><b>Log Out</b></a></li>
            </ul>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        var emailNotify = <?php echo $emailNotify; ?>;

        //Toggle button on or off
        if (emailNotify === 1)
        {
            $('#toggle-demo').bootstrapToggle('on');
        } else
            $('#toggle-demo').bootstrapToggle('off');
        
        //When email preference toggle is changed
        $('#toggle-demo').change(function(){
            if($(this).prop("checked") === true){
                emailNotify = 1;
                //console.log("This is on");
            } else {
                //console.log("This is off");
                emailNotify = 0;
            }
            
             //Ajax method to insert into users table in database and update email preference
            $.ajax({
                type: "POST",
                url: "emailPhonePrefPush.php",
                data: {emailNotify: emailNotify},
                success: function (data) {
                    //console.log(data);
                }
            });
        });

    </script>
</body>
