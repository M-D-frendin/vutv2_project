<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

//starta phps sessionshantering
session_start();

//visa alla php fel och notiser
error_reporting(-1);
error_reporting(E_ALL);
ini_set("display_errors", 1);    


//läs in configurationsvariabler
include_once('config.php');
