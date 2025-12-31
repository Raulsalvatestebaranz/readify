<?php
// --------------------------------------------------
// READIFY - Database Connection File
// This file connects the application to the MySQL
// database and is included in all files that need
// database access.
// --------------------------------------------------

// Create a connection to the MySQL database
// Parameters:
// - host: localhost (local server using XAMPP)
// - username: root
// - password: empty (default XAMPP setup)
// - database: readify
$link = mysqli_connect('localhost', 'root', '', 'readify');

// Check if the connection was successful
// If the connection fails, stop the script and
// display an error message
if (!$link) {
    die('Database connection error: ' . mysqli_connect_error());
}
?>
