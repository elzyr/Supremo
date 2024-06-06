<?php //require('navbar.php');?>
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
$calendar = new Calendar($conn);?>

<div id="calendar">
    <div class="box-calendar" >
        <?php echo $calendar->createHeader();?>
        <div class="box-content">
            <ul class="label"><?php echo $calendar->createDaysOfWeek();?></ul>
            <div class="clear"></div>
            <?php echo $calendar->showDayInCalendar($user);
            $conn->close();?>
        </div>
    </div>
</div>

</body>
</html>