<?php 
require('navbar.php');
require_once("php/verifyUser.php");
require('php/dbConnect.php');
include 'class/kalendarz-class.php';
?>
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
$calendar = new Calendar($conn);?>

<main class="main" >
    <?php echo $calendar->createHeader();?>
    <div class="box-content">
        <ul class="label"><?php echo $calendar->createDaysOfWeek();?></ul>
        <div class="clear"></div>
        <?php echo $calendar->showDayInCalendar($user);
        $conn->close();?>
    </div>
</main>


</body>
</html>