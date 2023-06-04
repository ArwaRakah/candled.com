<?php
session_start();
// Set the cookie
setcookie('my_cookie', 'cookie_value', time() + 3600, '/');

// Retrieve the cookie value
$cookieValue = $_COOKIE['my_cookie'];



// Check if the confirm button is clicked
if (isset($_POST['confirmed'])) {
    // Retrieve form data
   $cardname = sanitizeInput($_POST["cardname"]);
    $address = sanitizeInput($_POST["address"]);
    $cartTotal = sanitizeInput($_POST["cartTotal"]);
    
$cardname=basename($cardname);
$address = basename($address);

    // Empty the cart by resetting the session variable
    $_SESSION['cart'] = array();

}

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
        <style type="text/css">
        	.auto-style5 {
		color: #EC0C41;
		font-size: medium;
	}

        .auto-style7 {
		border-style: solid;
		border-width: 1px;
		margin-bottom: auto;
		color: #8E3046;
	}
		                   .auto-style10 {
      text-align: center;
      font-size: xx-large;
      color: #EEC5BF;
      background-color: #FFFFFF;
  }


    .auto-style11 {
	color: #8E3046;
}


    </style>
    <link rel="stylesheet" href="style.css">
</head>

<body>
 <?php include_once("include/header.php"); ?>
     <section id="page-header" class="auto-style10" style="height: 117px">
                        
                        <span class="auto-style11" >Confirmed</span>
			
                        
                        </section>

    <p id="us" class="auto-style5" ></p>
  



    <div class="auto-style7">
        <h2><strong>Order Details:</strong></h2>
        <ul>
            <li>Name: <?php echo $cardname; ?></li>
            <li>Address: <?php echo $address; ?></li>
            <li>Cart Total: $<?php echo $cartTotal; ?></li>
        </ul>
    </div>
    <?php include_once("include/footer.php"); ?>
    </body>
</html>
