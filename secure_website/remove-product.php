<?php
session_start();
// Set the cookie
setcookie('my_cookie', 'cookie_value', time() + 3600, '/');

// Retrieve the cookie value
$cookieValue = $_COOKIE['my_cookie'];


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'productKey' field is set
    if (isset($_POST['productKey'])) {
        $productKey = $_POST['productKey'];

        // Remove the product from the session cart based on the product key
        if (isset($_SESSION['cart']) && array_key_exists($productKey, $_SESSION['cart'])) {
            unset($_SESSION['cart'][$productKey]);
        }

        // Redirect back to the shopping cart page
        header('Location: shoppingcart.php');
        exit;
    }
}
?>
