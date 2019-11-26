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

// Include config file
    require_once "config.php";

// Define variables and initialize with empty values
    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate new password
        if (empty(trim($_POST["new_password"]))) {
            $new_password_err = "Please enter the new password.";
        } elseif (strlen(trim($_POST["new_password"])) < 6) {
            $new_password_err = "Password must have atleast 6 characters.";
        } else {
            $new_password = trim($_POST["new_password"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm the password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($new_password_err) && ($new_password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        // Check input errors before updating the database
        if (empty($new_password_err) && empty($confirm_password_err)) {
            // Prepare an update statement
            $sql = "UPDATE users SET password = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                // Set parameters
                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_id = $_SESSION["id"];

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    session_destroy();
                    // Password updated successfully. Destroy the session, and redirect to login page
//                    header("location: login.php");
//                    exit();
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
                                    window.location.replace("login.php"); //Navigate to home page
                                });',
                    '</script>';   
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        // Close connection
        mysqli_close($link);
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Reset Password</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body
            { 
                font: 14px sans-serif; 
                background-color: black;
            }

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
        </head>
        <body style="background-color: transparent;">
            <div class="outer">
                <div class="middle">
                    <div class="inner">
                        <center><h2>Reset Password</h2></center><br>
                        <p>Please fill out this form to reset your password.</p><br>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                                <span class="help-block"><?php echo $new_password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control">
                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
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
                <!-- Bootstrap Dropdown Hover JS -->
    <script src="jsFiles/dropDownJS/bootstrap-dropdownhover.min.js"></script>
        </body>
    </html>
