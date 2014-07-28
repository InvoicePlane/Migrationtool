<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
*/

// Get the request path
$requesturi = explode('?' , $_SERVER['REQUEST_URI']);
$requesturi = $requesturi[0];
$path       = explode('/' , $requesturi);

// Cut off the defined subdir from the config
if ( $path[1] == substr(SUBDIR,0,-1) ) {
    unset( $path[1] );
    $path = array_values($path);
}

