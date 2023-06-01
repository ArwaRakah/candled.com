<?php
session_start();
// Set the cookie
setcookie('my_cookie', 'cookie_value', time() + 3600, '/');

// Retrieve the cookie value
$cookieValue = $_COOKIE['my_cookie'];

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    $_SESSION['error'] = "You must log in/signup first";
    header('Location: home.php'); // Redirect to the login page or wherever you handle user authentication
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'product' field is set
    if (isset($_POST['product'])) {
        $productId = $_POST['product'];

        // Fetch product details from the database based on the product ID
        include("Database/db.php");
        $sql = "SELECT * FROM products WHERE id = '$productId'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);

            // Store the product in the session
            $_SESSION['cart'][] = $product;

            // Redirect to the shopping cart page to avoid form resubmission
            header('Location: shoppingcart.php');
            exit;
        }
    }
}


// Calculate the cart total
$cartTotal = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $product) {
        $cartTotal += $product['price'];
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Cmpatible" content="IE=edge">
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title> Candled Shop | Cart </title>
    <!-- css link -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- box icons -->
    <link href='http://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> 
	<style type="text/css">
	.auto-style2 {
		font-size: xx-small;
	}
	.auto-style3 {
		font-size: medium;
	}
	.auto-style5 {
	text-align: left;
	font-size: xx-large;
}
.auto-style6 {
	font-family: Arial;
}
	          
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 15%; /* IE10 */
  flex: 15%;
}

.col-50 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-75 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f8edeb;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
  color: #fec5bb;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #f8edeb;
  color: #ffb5a7;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
border: 1px solid lightgrey;
}

.btn:hover {
  background-color: #ffe5d9;
}

a {
  color: blue;
}

h3 {
  color: #415a77;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: black;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
	.auto-style10 {
		-ms-flex: 25%;
		flex: 25%;
		text-align: left;
		padding: 0 16px;
	}
	.auto-style11 {
		text-align: left;
	}
	.auto-style12 {
		background-color: #f8edeb;
		color: #8E3046;
		padding: 12px;
		margin: 10px 0;
		border: none;
		width: 100%;
		border-radius: 3px;
		cursor: pointer;
		font-size: 17px;
		border: 1px solid lightgrey;
	}
	.auto-style13 {
		color: #8E3046;
	}
	</style>
</head>
    
    <body>
      <main class="container">
        <?php include_once("include/header.php"); ?>
                <section id="page-header" class="about-header" style="height: 117px">
         <h2 style="color:#ffffff" class="auto-style5"><ion-icon name="cart-outline"></ion-icon>Shopping Cart</h2>
        <p> </p>
        </section>
        <br>
   

<br>
        <section id="cart" class="cart1">
    <div class="cart-item-box">
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
            <ul>
                <?php foreach ($_SESSION['cart'] as $key => $product) : ?>
                    <li>
                        <h3><?php echo $product['name']; ?></h3>
                        <p>Price: $<?php echo $product['price']; ?></p>
                        <?php if(isset($product['image'])) : ?>
                            <p>Image: <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="100" height="100"></p>
                        <?php else: ?>
                            <p>Image not available</p>
                        <?php endif; ?>
                        <form method="post" action="remove-product.php">
                            <input type="hidden" name="productKey" value="<?php echo $key; ?>">
                            <input type="submit" class="btn" value="Remove">
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Your shopping cart is empty.</p>
        <?php endif; ?>
        
        <p><a href="shop.php">Continue shopping</a></p>
    </div>
</section>
        <section class="checkout">
        <div id="subtotal">
            <h3>Cart Total</h3>
            <table>
                <tr>
                    <td>Number of Items</td>
                    <td><?php echo count($_SESSION['cart']); ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id="total"><strong>$<?php echo $cartTotal; ?></strong></td>
                </tr>
            </table>
        </div>
    </section>
    
      <section class="checkout">
 
            <div class="container">
                <form method="post" action="confirmed.php">
                    <div class="auto-style10">
                        <h3>Reservation</h3>
                        <label for="cname" class="auto-style13">
						<div class="auto-style11">
							Name</div>
						</label>
                        &nbsp;<input type="text" id="cname" name="cardname" placeholder="John More Doe" class="auto-style13" required>
                        <label for="ccnum" class="auto-style13">Address</label>
                        <input type="text" id="ccnum" name="address" placeholder="DM-NUZHA-22883" class="auto-style13" required>
					<label for="file" class="auto-style13">Upload the Transaction File:</label>
        				<input type="file" name="file" required>
        				<input type="hidden" name="cartTotal" value="<?php echo $cartTotal; ?>">
                    
                        <input type="submit" class="auto-style12" name="confirmed" value="confirmed" style="width: 9%"><br>
                        <input type="reset" class="auto-style12" value="Cancel" style="width: 9%">
                    </div>

                </form>
            </div>
  
</section>  
<div class="col-75">
	  <div class="container">
        <?php include_once("include/footer.php"); ?>
                    </div>
            </div>
      </main>        
  
 <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


        
    </body>
    </html>
    