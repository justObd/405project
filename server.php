<?php

// Handle API requests
if (preg_match('/^\/api\/(.*)/', $_SERVER["REQUEST_URI"], $matches)) {
    $_GET['url'] = $matches[1];
    require_once 'api/' . $matches[1];
    exit;
}

// Serve static files from the public directory
if (is_file(__DIR__ . '/public' . $_SERVER["REQUEST_URI"])) {
    return false; // serve the requested resource as-is.
}

// For other requests, serve the main HTML file
include 'public/index.html';