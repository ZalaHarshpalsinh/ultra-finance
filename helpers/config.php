<?php

define('DB_SERVER', getenv('ULTRA_FINANCE_DB_SERVER'));
define('DB_USERNAME', getenv('ULTRA_FINANCE_DB_USERNAME')); //write the username
define('DB_PASSWORD', getenv('ULTRA_FINANCE_DB_PASSWORD')); //write the password
define('DB_NAME', getenv('ULTRA_FINANCE_DB_DATABASE_NAME')); //write the db name    

/* Attempt to connect to MySQL/MariaDB database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ( $link === false )
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
