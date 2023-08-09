<?php
// AFTER RUNNING THIS FILE, IMPORT 'installation.sql' into phpMyAdmin

$conn = mysqli_connect('localhost', 'root', '');


// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Create database

$sql = "CREATE DATABASE quizzversedb";

if (mysqli_query($conn, $sql)) echo "Database created successfully";
else  echo "Error creating database: " . mysqli_error($conn);


// Close connection

mysqli_close($conn);


?>