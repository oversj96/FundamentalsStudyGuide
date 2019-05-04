<?php

DEFINE ('DB_USER', 'oversj96');
DEFINE ('DB_PASSWORD', 'passtest');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'math300');

$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL' .
    mysqli_connect_error());

?>