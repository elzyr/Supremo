<?php require('navbar.php');?>
<html>
<head>   
<link href="css/kalendarz.css" type="text/css" rel="stylesheet" />
<title>Kalendarz</title>
</head>
<body>
<?php
include 'class/kalendarz-class.php';
require("php/verifyUser.php");
require('php/dbConnect.php');
 
$calendar = new Calendar($conn);
 
echo $calendar->show($user);
?>
</body>
</html>