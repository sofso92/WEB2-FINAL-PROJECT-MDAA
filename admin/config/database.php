<?php
require 'constants.php';

// connect to the database
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_errno($connection)) {
    die(mysqli_error($connection));
}


// try {
//     // Try creating new PDO connection to MySQL.
//     $db = new PDO(DB_DSN, DB_USER, DB_PASS);
//     //,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
// } catch (PDOException $e) {
//     print "Error: " . $e->getMessage();
//     die(); // Force execution to stop on errors.
//     // When deploying to production you should handle this
//     // situation more gracefully. ¯\_(ツ)_/¯
// }
?>