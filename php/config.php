<?php
$serverName = "localhost";
$databaseName = "genarel_knowlage_website";
$userName = "root";
$password = "";

$con = mysqli_connect($serverName, $userName, $password);
mysqli_select_db($con, $databaseName);

