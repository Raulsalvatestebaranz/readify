<?php
# --------------------------------------------
# READIFY - Database Connection (Local)
# Course-level, procedural PHP
# --------------------------------------------

# Connect to MySQL database
$link = mysqli_connect('localhost', 'root', '', 'readify');

# Check connection
if (!$link) {
    die('Database connection error: ' . mysqli_connect_error());
}
?>
