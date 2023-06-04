<?php

include("Database/db.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the statement
    $stmt = mysqli_prepare($db, "INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPassword);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Registration successful, redirect to login page
        header("Location: account.php");
        exit();
    } else {
        // Registration failed
        echo "<script>document.getElementById('test').innerHTML = 'Error occurred while registering. Please try again.';</script>";
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
    <meta http-equiv="X-UA-Cmpatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candle Shop | Sign Up</title>
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
<?php include_once("include/header.php"); ?>
<section id="account-page">
    <div class="container">
        <div class="row">
            <section id="page-header" class="auto-style5" style="height: 117px">
                <span class="auto-style7">Sign Up</span>
            </section>
            <div class="col-2">
                <div class="auto-style8" style="left: 19px; top: 14px">
                    <form name="accountForm" method="post" action="Signup.php" onsubmit="return validateForm()"
                          class="section-p1">
                        <span class="auto-style7">
                            <label>Name:</label>
                        </span>
                        <input type="text" name="name" placeholder="Name" class="newStyle1"><br>
                        <span class="auto-style7">
                            <label>Email:</label>
                        </span>
                        <input type="email" name="email" placeholder="Email" class="newStyle1"><br>
                        <span class="auto-style7">
                            <label>Username:</label>
                        </span>
                        <input type="text" name="username" placeholder="Username" class="newStyle1"><br>
                        <span class="auto-style7">
                            <label>Password:</label>
                        </span>
                        <input type="password" name="password" placeholder="Password" class="newStyle1"><br>
                        <br>
                        &nbsp;
                        <button type="submit" class="newStyle1" name="signup_user">Sign Up</button>
                    </form>
                    <p id="test"></p>
                </div>
            </div>
        </div>
    </div>
</section>
<p id="test" class="auto-style9"></p>

<?php include_once("include/footer.php"); ?>
<script type="text/javascript">
    function validateForm() {
        var name = document.forms["accountForm"]["name"].value;
        var email = document.forms["accountForm"]["email"].value;
        var username = document.forms["accountForm"]["username"].value;
        var password = document.forms["accountForm"]["password"].value;
        
        if (name == null || name === "") {
            alert("Name must be filled out");
            return false;
        }
        if (email == null || email === "") {
            alert("Email must be filled out");
            return false;
        }
        if (username == null || username === "") {
            alert("Username must be filled out");
            return false;
        }
        if (password == null || password === "") {
            alert("Password must be filled out");
            return false;
        }
    }
</script>

</body>
</html>
