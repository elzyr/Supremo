<?php require('navbar.php');?>
<html>
<head>   
<link href="css/kalendarz.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
include 'class/kalendarz-class.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html>