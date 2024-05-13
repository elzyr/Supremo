<?php
require("php/verifyUser.php");
require('php/dbConnect.php');
include('class/PlanTygodnia.php');

$taskScheduler = new PlanTygodnia($conn);

$date = isset($_GET['date']) ? new DateTime($_GET['date']) : new DateTime();
$date->setISODate($date->format('o'), $date->format('W'), 1);
$interval = new DateInterval('P1D');

$days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/plan-tygodnia.css">
    <title>Plan tygodnia</title>
</head>

<body>
    <div class="container">
        <?php
        $taskScheduler->displayDayTasks($date, $days, $user);
        $conn->close();
        ?>
    </div>
</body>

</html>