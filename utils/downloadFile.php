<?php
    session_start();
    include "../../utils/prevent.php";
    isAuthenticated();
    isAuthorzied();

if(isset($_REQUEST["file"])){
    // Get parameters
    //$file = urldecode($_REQUEST["file"]); // Decode URL-encoded string
    $file="tours.csv";

    /* Check if the file name includes illegal characters
    like "../" using the regular expression */
    //preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)
    if(true){
        //$filepath = "images/" . $file;

        // Process download
        if(file_exists($file)) {
            echo "Yes";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            flush(); // Flush system output buffer
            readfile($file);
            die();
        } else {
            
            http_response_code(404);
	        die();
        }
    } else {
        die("Invalid file name!");
    }
}
?>