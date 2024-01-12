<?php

$sections = [];

function section_start($sectionName)
{
    global $sections;
    ob_start();
    $sections[$sectionName] = '';
}

function section_end()
{
    global $sections;
    $sectionName = array_key_last($sections);
    $sections[$sectionName] = ob_get_clean();
}

function route(string $method, string $path, callable $callback)
{
    $uri = strtok($_SERVER['REQUEST_URI'], '?'); // Menangani query string
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    $pathSegments = explode('/', trim($path, '/'));
    $uriSegments = explode('/', trim($uri, '/'));

    // Check if method and path match
    if ($requestMethod === $method) {
        $matched = true;
        $params = [];

        // Check each segment
        foreach ($pathSegments as $index => $segment) {
            // Check if the segment is a dynamic parameter
            if (strpos($segment, '{') === 0 && strpos($segment, '}') === strlen($segment) - 1) {
                // Extract dynamic parameter value
                $paramName = trim($segment, '{}');
                $params[$paramName] = $uriSegments[$index] ?? null;
            } elseif ($uriSegments[$index] !== $segment) {
                // If any segment doesn't match, set matched to false
                $matched = false;
                break;
            }
        }

        // If everything matches, call the callback with parameters
        if ($matched) {
            try {
                echo $callback($params);
            } catch (Exception $e) {
                // Handle errors here
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
