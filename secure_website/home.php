<?php
session_start();
// Set the cookie
setcookie('my_cookie', 'cookie_value', time() + 3600, '/');

// Retrieve the cookie value
$cookieValue =0;
$cookieValue = $_COOKIE['my_cookie'];


if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $error = "You must log in/signup first";
}

//$_GET['searchInput']="";
//if (isset($_GET['searchInput'])){
//$query = $_GET['searchInput'];

//if (!empty($query)) {
    //$includeFile = "".$query;
    //include($includeFile);
//} else {
   // include("home.php");

//}
//}

if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Cmpatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title> Candled | Home </title>
    <!-- link to the css-->
    <link rel="stylesheet" href="style.css">
    <!-- box icons -->
    <link href='http://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <style>
            .auto-style5 {
      text-align: center;
      font-size: xx-large;
      color: #EEC5BF;
      background-color: #FFFFFF;
  }
   .auto-style7 {
      color: #8E3046;
  }
    .auto-style8 {
        border-style: solid;
			border-width: 1px;
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
         <section id="page-header" class="auto-style5" style="height: 117px">
                        
                        <span class="auto-style7">Welcome to Candled Shop!</span>
			
                        
                        </section>

<br><br>
<p id="test" class="auto-style9">
    <?php
    if (isset($error)) {
        echo $error;
    }
    else{
    echo "Welcome ".$username;
    }
    ?>
<br><br>
<div class="auto-style8"style="left: 19px; top: 14px; height: 290px;">
                                <span class="auto-style7">
                            </span><button type="button" class="newStyle1" name="login_user"><a href="account.php">Login</a></button><br><br>
                            
                                <span class="auto-style7">
                            
</span><br>
                                <button type="button" class="newStyle1" name="signup_user" ><a href="Signup.php">Sign Up</a></button>
                                <br>
                                &nbsp;<br>
            <a href="home.php?logout=true" class="newStyle1">Log Out</a><br>
                                </div><br><br>




<?php include_once("include/footer.php"); ?>
</body>
</html>
