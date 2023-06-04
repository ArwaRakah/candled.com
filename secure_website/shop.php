<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>Candled Shop | Products Page</title>
    <!-- link to the css-->
    <link rel="stylesheet" href="style.css">
    <!-- box icons -->
    <link href='boxicons.min.css' rel='stylesheet'> 
    <style type="text/css">
        .auto-style1 {
            font-family: "Bahnschrift SemiLight Condensed";
        }
        .auto-style2 {
            color: #FF6666;
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
</head>

<body>
<?php include_once("include/header.php"); ?>
    <section id="page-header" class="auto-style10" style="height: 117px">
                        
                        <span class="auto-style11"  >Products</span>
			
                        
                        </section>

<br> <span style="color: #EEC5BF; font-size: 350%; text-align: center;" class="auto-style1">Handmade Natural scented candles!</span>

<form action="shoppingcart.php" method="post">
    <?php
    // Database connection
    require_once("Database/db.php");
   
    // Fetch products from the database
    $sql = "SELECT * FROM products";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productID = $row["id"];
            $productName = $row["name"];
            $productPrice = $row["price"];
            $productImage = $row["image"];
    ?>
            <div>
                <button type="submit" name="product" value="<?php echo $productID; ?>" class="auto-style2">
                    <p><?php echo $productName; ?></p>
                    <img src="img/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" title="<?php echo $productName; ?>" width="400" height="400" />
                </button>
                <br><span class="auto-style8">$<?php echo $productPrice; ?></span>
                <br>
                <button type="submit" name="product" value="<?php echo $productID; ?>" class="auto-style2">add to cart</button>

            </div>
    <?php
        }
    } else {
        echo "No products found.";
    }

    mysqli_close($db);
    ?>
</form>



<br><br><br><br>
<?php include_once("include/footer.php"); ?>
</body>
</html>
