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

include_once 'config.php';

include_once 'includeMenu.php';

// Define variables and initialize with empty values
$new_email = "";
$new_email_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new email
    if (empty(trim($_POST["new_email"]))) {
        $new_email_err = "Please enter the new email.";
    } elseif (!filter_var($_POST["new_email"], FILTER_VALIDATE_EMAIL)) {
        $new_email_err = "Invalid email format";
    } else {
        $new_email= trim($_POST["new_email"]);
    }

    // Check input errors before updating the database
    if (empty($new_email_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET email = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_email, $param_id);

            // Set parameters
            $param_email = $new_email;
            $param_id = $_SESSION["id"];
        
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                header("location: index.php");
                exit();
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
                        <center><h2>Change Email</h2></center><br>
                        <p>Please fill out this form to change your email.</p><br>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                            <div class="form-group <?php echo (!empty($new_email_err)) ? 'has-error' : ''; ?>">
                                <label>New Email</label>
                                <input type="text" name="new_email" class="form-control" value="<?php echo $new_email; ?>">
                                <span class="help-block"><?php echo $new_email_err; ?></span>
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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
                <!-- Bootstrap Dropdown Hover JS -->
            <script>
            function changePassword(){
//                Swal.fire({
//                icon: 'success',
//                title: 'Congrats!',
//                text: 'Your email was successfully changed!'
//            });
//            $(Swal.getConfirmButton()).click(function () {
//                window.location.replace('index.php'); //Navigate to home page
//            });
        }
            </script>
    </body>
</html>


