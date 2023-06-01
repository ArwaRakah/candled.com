<?php
session_start();
// Set the cookie
setcookie('my_cookie', 'cookie_value', time() + 3600, '/');

// Retrieve the cookie value
$cookieValue = $_COOKIE['my_cookie'];


$uploadError='';
$uploadmsg='';
$uploadErrorMsg='';

// Check if the confirm button is clicked
if (isset($_POST['confirmed'])) {
    // Retrieve form data
    $cardname = $_POST['cardname'];
    $address = $_POST['address'];
    $cartTotal = $_POST['cartTotal'];

    // Empty the cart by resetting the session variable
    $_SESSION['cart'] = array();

 // Check if a file was uploaded successfully
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file']['tmp_name']; // Temporary file path
    $fileName = $_FILES['file']['name']; // Original file name
    $destination = 'uploads/' . $fileName; // Destination path to save the file

    // Move the uploaded file to the desired location
    if (move_uploaded_file($file, $destination)) {
        $uploadmsg = 'File uploaded successfully.';
    } else {
        $uploadError = 'Failed to move the uploaded file.';
    }
} elseif (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
    // Error occurred during file upload
    $uploadErrorMsg = 'File upload error: ' . $_FILES['file']['error'];
}
}
?>

<?php 

if (isset($_FILES['file'])) {
    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $targetDir = 'uploads/';
        $targetFile = $targetDir . basename($_FILES['file']['name']);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            echo '<p>File uploaded successfully!</p>';
            echo '<p>Uploaded file: ' . $targetFile . '</p>';
        } else {
            echo '<p>Failed to move the uploaded file.</p>';
        }
    } else {
        echo '<p>Error uploading file.</p>';
    }
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
    <?php
if (isset($uploadmsg)) {
    echo '<p id="to" class="auto-style9">' . $uploadmsg . '</p>';
}
else{
    echo '<p id="to" class="auto-style9">' . $uploadError . '</p>';
}
?><br>
         <?php
if (isset($uploadErrorMsg)) {
    echo '<p id="te" class="auto-style9">' . $uploadErrorMsg . '</p>';
}
?>
       <br>
<br><br>

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
