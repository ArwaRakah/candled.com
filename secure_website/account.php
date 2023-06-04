<?php
require("Database/db.php");

// Start session
session_start();
// Set the cookie
setcookie('my_cookie', 'cookie_value', time() + 3600, '/');

// Retrieve the cookie value
$cookieValue = $_COOKIE['my_cookie'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the username and password from the form
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    // Prepare the statement
    $stmt = mysqli_prepare($db, "SELECT password FROM users WHERE username = ?");

    // Bind the parameter to the statement
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind the result
    mysqli_stmt_bind_result($stmt, $hashedPassword);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Valid login credentials
        $_SESSION["username"] = $username;
        header('Location: home.php');
        exit();
    } else {
        // Invalid username or password
        $error = "Invalid username or password";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($db);

// Sanitize user input
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candled Shop | Account</title>
    <!-- link to the css-->
    <link rel="stylesheet" href="style.css">
    <!-- box icons -->
    <link href='http://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style type="text/css">
        .auto-style5 {
            text-align: center;
            font-size: xx-large;
            color: #EEC5BF;
            background-color: #FFFFFF;
        }

        .auto-style6 {
            color: #F1D3CE;
        }

        .auto-style7 {
            color: #8E3046;
        }

        .auto-style8 {
            background: #fff;
            width: 300px;
            height: 400px;
            position: relative;
            text-align: center;
            padding: 20px 0;
            margin: auto;
            color: #FEC5BB;
        }

        .auto-style9 {
            text-align: center;
            color: #8E3046;
        }
    </style>
</head>
<body>
<div id="display-image">
</div>
<?php include_once("include/header.php"); ?>
<section id="account-page">
    <div class="container">
        <div class="row">
            <section id="page-header" class="auto-style5" style="height: 117px">
                <span class="auto-style7">Login</span>
            </section>
            <div class="col-2">
                <div class="auto-style8" style="left: 19px; top: 14px">
                    <form name="accountForm" method="post" action="account.php" onsubmit="return validateForm()" class="section-p1">
                        <span class="auto-style7">
                            <label>Username:</label>
                        </span>
                        <input type="text" name="username" placeholder="Username" class="newStyle1">
                        <br>
                        <span class="auto-style7">
                            <label>Password:</label>
                        </span>
                        <input type="password" name="password" placeholder="Password" class="newStyle1">
                        <br>
                        <br>
                        <button type="submit" class="newStyle1" name="login_user">Login</button>
                    </form>
                    <p id="test" class="auto-style9">
    <?php
    if (isset($error)) {
        echo $error;
    }
    ?>
</p>

                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once("include/footer.php"); ?>
<script type="text/javascript">
    function validateForm() {
        var username = document.forms["accountForm"]["username"].value;
        if (username == null || username == "") {
            alert("Username must be filled out");
            return false;
        }
        var password = document.forms["accountForm"]["password"].value;
        if (password == null || password == "") {
            alert("Password must be filled out");
            return false;
        }
    }
</script>
</body>
</html>
