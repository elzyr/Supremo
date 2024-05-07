<?php require('navbar.php');

require_once 'class/kalendarz.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kalendarz</title>
    <link rel="stylesheet" href="css/kalendarz.css" />
</head>
<body>

<?php
// Integracja kalendarza PHP z HTML
$calendar = new Kalendarz(new ObecnaData(), new KalendarzData());
$calendar->create();
$weeks = $calendar->getWeeks();
$monthLabels = $calendar->getMonthLabels();
$dayLabels = $calendar->getDayLabels();
$currentMonth = $calendar->getCalendarMonth();
$currentYear = $calendar->getCalendarDate()->getYear(); // Dodane pobieranie aktualnego roku

echo "<h2>$currentMonth $currentYear</h2>"; // Dodane wyświetlanie miesiąca i roku
?>

<table>
    <thead>
    <tr>
        <?php foreach ($dayLabels as $label): ?>
            <th><?= $label ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($weeks as $week): ?>
        <tr>
            <?php foreach ($week as $day): ?>
                <?php if ($day['currentMonth']): ?>
                    <td class="current-month"><?= $day['dayNumber'] ?></td>
                <?php else: ?>
                    <td class="other-month"><?= $day['dayNumber'] ?></td>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
