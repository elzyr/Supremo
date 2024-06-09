<?php
require('navbar.php');
require("php/verifyUser.php");
require('php/dbConnect.php');
include('class/WeekSchedule.php');

$taskScheduler = new WeekSchedule($conn);

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
    <main>
        <?php if (isset($_COOKIE['success_message'])) : ?>
            <div class="cookie-message success"><?php echo htmlspecialchars($_COOKIE['success_message']); ?></div>
            <?php setcookie("success_message", "", time() - 3600, "/"); ?>
        <?php endif; ?>

        <?php if (isset($_COOKIE['error_message'])) : ?>
            <div class="cookie-message error"><?php echo htmlspecialchars($_COOKIE['error_message']); ?></div>
            <?php setcookie("error_message", "", time() - 3600, "/"); ?>
        <?php endif; ?>

        <?php
        $taskScheduler->displayDayTasks($date, $days, $user);
        $conn->close();
        ?>
    </main>
</body>

</html>