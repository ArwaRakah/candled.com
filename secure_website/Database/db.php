<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'candled');

// Make the connection:
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) ;
if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL '. mysqli_connect_errno();
}

// Set the encoding...
mysqli_set_charset($db, 'utf8');

  ?>
