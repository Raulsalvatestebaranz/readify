<?php
// --------------------------------------------------
// Session Bootstrap – READIFY
// Ensures a PHP session is started only once
// --------------------------------------------------

// Check if a session has already been started
// This prevents warnings or errors from calling
// session_start() multiple times
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
