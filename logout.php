<?php
require "includes/session.php";

/* Destroy session safely */
session_unset();
session_destroy();

/* Start fresh session for message */
session_start();
$_SESSION["logout_success"] = "You have been logged out successfully.";

header("Location: index.php");
exit;
?>
