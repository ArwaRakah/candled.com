
<?php
require_once("Database/db.php");

// Check if the form is submitted
$uploadError='';
$uploadmsg='';
$uploadErrorMsg='';
$msg='';
$errorMsg='';

$Pages=array('shop','account','team','home','Us','shoppingcart');
if (isset($_POST['searchInput'])) {
    $query = $_POST['searchInput'];
    if (in_array($query, $Pages)) {
        $query = basename($query);
        if ($query == 'shop' || $query == 'account' || $query == 'team' || $query == 'home' || $query == 'Us' || $query == 'shoppingcart') {
            include_once($query . ".php");
        }
    } else {
        echo "This page is not available.";
    }
}

if (isset($_POST['submit'])) {
       // Retrieve user inputs
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $feedback = filter_var($_POST['textareafeedback'], FILTER_SANITIZE_STRING);

    // Prepare the SQL statement
    $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";

// Execute the query
if (mysqli_query($db, $sql)) {
    // Feedback stored successfully
    $msg = 'Thank you for your feedback!';
    
  }else {
    // Failed to store feedback
    $errorMsg = "Error: " . mysqli_error($db);
}

$allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

if (
    isset($_FILES['file']) &&
    $_FILES['file']['error'] === UPLOAD_ERR_OK &&
    in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)), $allowedExtensions)
) {
    $file = $_FILES['file']['tmp_name']; // Temporary file path
    $fileName = basename($_FILES['file']['name']); // Original file name
    $destination = 'uploads/' . $fileName; // Destination path to save the file

    // Move the uploaded file to the desired location
    if (move_uploaded_file($file, $destination)) {
        $uploadMsg = 'File uploaded successfully.';
    } else {
        $uploadErrorMsg = 'Failed to move the uploaded file.';
    }
} else {
    // Error occurred during file upload
    $uploadErrorMsg = 'File upload error: ';
    if (!isset($_FILES['file']['error'])) {
        $uploadErrorMsg .= 'No file uploaded. ';
    } elseif ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $uploadErrorMsg .= 'Error code: ' . $_FILES['file']['error'];
    } else {
        $uploadErrorMsg .= 'Invalid file format.';
    }
}
}




?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Cmpatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>Candled Shop | Contact</title>
    <link rel="stylesheet" href="style.css">
    <link href="http://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet"> 
	<style type="text/css">
	.auto-style1 {
		color: #8E3046;
	}
	.auto-style2 {
		color: #C35972;
	}
	.auto-style5 {
		color: #EC0C41;
		font-size: medium;
	}
	.auto-style6 {
		color: #8E3046;
		margin-left: 467;
	}
	               .auto-style10 {
      text-align: center;
      font-size: xx-large;
      color: #EEC5BF;
      background-color: #FFFFFF;
  }


	.auto-style11 {
		color: #8E3046;
		border: 1px solid #8E3046;
		margin-right: 0;
		background-color: #FEC5BB;
	}
	.auto-style12 {
		border-style: solid;
		border-width: 1px;
	}


	.auto-style13 {
		color: #C35972;
		font-size: x-large;
	}


	</style>
</head>
    
<body>
    <?php include_once("include/header.php"); ?>
    <section id="page-header" class="auto-style10" style="height: 117px">
                        
                        <span class="auto-style1" >Contact us</span>
			
                        
                        </section>

        <p id="us" class="auto-style5" ></p>
    <section id="contact-details" class="section-p1">
             <?php
if (isset($msg)) {
    echo '<p id="us" class="auto-style9">' . $msg . '</p>';
}
else{
    echo '<p id="to" class="auto-style9">' . $errorMsg . '</p>';
}
?>   <br>    
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
       
              <div>
            <br>
            
            <br class="auto-style2">
            <h2 class="auto-style13">
                You can reach us anytime!
            </h2>
             <h3 style="color: #EEC5BF">Customer Care Email: Candled@outlook.com</h3>
            <br><br>
            <h1>
                <span style="font-size: 130%" class="auto-style2">Share your feedback</span>
            </h1>
            <div class="cart-item-box" style="width: 1028px">
            <form method="POST" action="Us.php" enctype="multipart/form-data">
                <span class="auto-style1">
                <label class="form-label">Name</label></span>
                <input type="text" class="auto-style1" id="example name" name="name" required><br class="auto-style1">
				<br class="auto-style1">
                <span class="auto-style1">
                <label class="form-label">Email</label></span>
                <input type="email" class="form-control" id="example.email" name="email" required><br><br>
                <span class="auto-style1">
                <label class="form-label">Feedback</label></span>
                <input type="textarea" class="auto-style1" id="textareafeedback" name="textareafeedback" required style="height: 87px"><br class="auto-style1">
				<br class="auto-style1">
                <span class="auto-style1">File:</span> <input type="file" name="file"><br><br>
                <br/>
                &nbsp;<input type="submit" value="Submit" name="submit" class="auto-style6" style="width: 15%"></form>
            </div>
            <br><br>
           
        </div>
        <div id="feedbacks">
        <?php
        
        // Retrieve all feedbacks from the database
        $feedbacksQuery = "SELECT * FROM feedback";
        $result = mysqli_query($db, $feedbacksQuery);

        if (mysqli_num_rows($result) > 0) {
            // Display each feedback
            echo '<div id="feedbacks">';
            while ($row = mysqli_fetch_assoc($result)) {
                $comName= $row['name'];
                $comEmail=  $row['email'];
                $comFeedback=  $row['feedback'];
                $comFeedback= preg_replace('/(?<!href="|">)((http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?)/i', '<a href="$1" target="_blank">$1</a>', $comFeedback);
         ?>
            <table class="auto-style11" style="width: 36%; height: 90">
				<tr>
					<td class="auto-style12" style="width: 385px">name: <?php echo $comName; ?></td>
					<td class="auto-style12" style="width: 805px">email: <?php echo $comEmail; ?></td>
				</tr>
				<tr>
					<td class="auto-style12" colspan="2">feedback: <?php echo $comFeedback; ?></td>
				</tr>
			</table>
			<br>
&nbsp;<?php
            }
            
        } else {
            $NoCom= 'No feedbacks found';
        }
    
 mysqli_close($db);
        ?></div>

    </section>
            
 <?php include_once("include/footer.php"); ?>        
</body>
</html>