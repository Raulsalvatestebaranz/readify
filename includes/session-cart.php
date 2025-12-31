<?php
// --------------------------------------------------
// Session Cart Bootstrap – READIFY
// Ensures session and cart array exist
// --------------------------------------------------

require __DIR__ . "/session.php";

// Initialise cart if not already set
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}
