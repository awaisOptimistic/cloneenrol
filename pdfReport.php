<?php
include "lib/lib.php";
include "config.php";
$id = $_GET['id'];

/***
 *
 *  PRINT CERTIFICATE FILE
 *
 */

printPDF($id);
