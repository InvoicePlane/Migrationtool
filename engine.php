<?php
/*
|
| FusionInvoice to InvoicePlane
| Database conversion tool
|
*/

// Get the request path
$requesturi = explode('?' , $_SERVER['REQUEST_URI']);
$requesturi = mysql_real_escape_string($requesturi[0]);
$path       = explode('/' , $requesturi);
