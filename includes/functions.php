<?php
/*
    built in function used:
    
    trim()
    stripslashes()
    htmlspecialchars()
    strip_tags()
    str_replace()

*/

function validateFormData($data) {
    $data = trim($data);            // Remove whitespace from the beginning and end of the string
    $data = stripslashes($data);    // Remove backslashes (\) from the string
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;                   // Return the sanitized data
}

?>