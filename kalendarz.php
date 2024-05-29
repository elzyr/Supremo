
<html>
<head>   
<link href="css/kalendarz.css" type="text/css" rel="stylesheet" />
<title>Kalendarz</title>
</head>
<body>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const tasks = document.querySelectorAll('.task');
            tasks.forEach(task => {
                task.addEventListener('mouseenter', function() {
                });
                task.addEventListener('mouseleave', function() {
                });
            });
        });
</script>
<?php
include 'class/kalendarz-class.php';
require("php/verifyUser.php");
require('php/dbConnect.php');
$calendar = new Calendar($conn);

echo $calendar->show($user);
?>
</body>
</html>
