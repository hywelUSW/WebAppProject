<?php
//initialise session
session_start();
//define the document root as this is in a subdirectory
$root = "/students/15080900/projectapp/";
$phpRoot = $_SERVER['DOCUMENT_ROOT'] . $root;
$header = $root."header.php";
?>