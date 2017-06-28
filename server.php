<?php
/**
 * Server script.
 */

# Get the URI
$uri = urldecode(
	parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

# Check if it corresponds to a public file
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
	return false;
}

# Include the index script otherwise
require_once __DIR__ . '/public/index.php';