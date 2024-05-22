<?php require('navbar.php');?>
<html>
<head>   
<link href="css/kalendarz.css" type="text/css" rel="stylesheet" />
<title>Kalendarz</title>
</head>
<body>
<?php
include 'class/kalendarz-class.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html>