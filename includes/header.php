<?php
// --------------------------------------------------
// Header Include – READIFY
// Starts the session and outputs the HTML document head
// --------------------------------------------------

// Ensure a session is started (safe to include multiple times)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Page title (defaults to READIFY if not set) -->
    <title><?= $page_title ?? 'READIFY' ?></title>

    <!-- Bootstrap CSS (CDN) -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Custom CSS for additional styling -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
