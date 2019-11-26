<html style="background-image: url(images/bgImg.jpg); background-size: cover;">
    <?php
    include_once 'title.php';
// Initialize the session
    session_start();

// Check if the user is logged in, if not then redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    include_once 'includeMenu.php';

    include_once 'config.php';

// Define variables and initialize with empty values
    $new_phone = "";
    $new_phone_err = "";

// Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Validate new Phone number
        if (empty($_POST["new_phone"])) {
            $new_phone_err = "Phone number is required";
        } elseif (strlen(trim($_POST["new_phone"])) != 11) {
            $new_phone_err = "Phone number must be 11 characters.";
        } else {
            $new_phone = trim($_POST["new_phone"]);
        }

        // Check input errors before updating the database
        if (empty($new_phone_err)) {
            // Prepare an update statement
            $sql = "UPDATE users SET phoneNumber = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_phone, $param_id);

                // Set parameters
                $param_phone = $new_phone;
                $param_id = $_SESSION["id"];

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Phone number updated successfully. Redirect to login page
//                header("Location: index.php"); //Not working
//                exit(); //Not working
                    //Escape directly to javascript from php (javascript within php)
                    echo '<link href="cssFiles/swal2Size.css" rel="stylesheet">';
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>';
                    echo '<script type="text/javascript">',
                    'Swal.fire({
                                    icon: "success",
                                    title: "Congrats!",
                                    text: "Your phone number was successfully changed!"
                                });
                                $(Swal.getConfirmButton()).click(function () {
                                    window.location.replace("index.php"); //Navigate to home page
                                });',
                    '</script>';
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Reset Password</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">

            .outer {
                display: table;
                position: absolute;
                /*                top: 25%;*/
                left: 0;
                height: 60%;
                width: 100%;
            }

            .middle {
                display: table-cell;
                vertical-align: middle;
            }

            .inner {
                margin-left: auto;
                margin-right: auto;
                width: 450px;
                border: 3px solid seagreen;
                border-radius: 20px;
                background-color: white;
                padding: 20px;
            </style>
            <script src="jsFiles/dropDownJS/bootstrap-dropdownhover.min.js"></script>

        </head>
        <body style="background-color: transparent;">
            <div class="outer">
                <div class="middle">
                    <div class="inner">
                        <center><h2>Change Phone Number</h2></center><br>
                        <p>Please fill out this form to change your phone number.</p><br>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                            <div class="form-group <?php echo (!empty($new_phone_err)) ? 'has-error' : ''; ?>">
                                <label>New Phone Number</label>
                                <input type="text" name="new_phone" class="form-control" placeholder="Please enter an 11 phone number" value="<?php echo $new_phone; ?>">
                                <span class="help-block"><?php echo $new_phone_err; ?></span>
                            </div>
                            <div class="form-group">
                                <center><input type="submit" class="btn btn-primary" value="Submit"></center>
                                <br>
                                <center><a class="btn btn-link" href="index.php">Cancel</a></center>
                            </div>
                        </form>
                    </div>   
                </div>   
            </div>  
        </body>
    </html>


