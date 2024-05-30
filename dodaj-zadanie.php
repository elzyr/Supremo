<?php
require("php/verifyUser.php");
require('php/dbConnect.php');
include("class/Task.php");

if (!isset($_GET['taskDate'])) {
    setcookie("error_message", "Nie podano daty!", time() + 5, "/");
    echo '<script type="text/javascript">
       window.history.back();
      </script>';
}
$taskDate = $conn->real_escape_string($_GET['taskDate']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $conn->real_escape_string($_POST['date']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $startTime = $conn->real_escape_string($_POST['start_time']);
    $endTime = $conn->real_escape_string($_POST['end_time']);
    $userId = $user->getId();
    $startDateTime = "$date $startTime";
    $endDateTime = "$date $endTime";

    $minHour = new DateTime('08:00');
    $maxHour = new DateTime('20:00');
    $startHour = new DateTime($startTime);
    $endHour = new DateTime($endTime);

    if (empty(trim($title))) {
        $error = "Tytuł nie może być pusty.";
    } elseif (strtotime($endTime) <= strtotime($startTime)) {
        $error = "Czas zakończenia musi być późniejszy niż czas rozpoczęcia.";
    } elseif ($startHour < $minHour || $startHour > $maxHour || $endHour < $minHour || $endHour > $maxHour) {
        $error = "Czas zadania musi być w przedziale 8:00 - 20:00.";
    } else {
        if (!(Task::checkAvailability($startDateTime, $endDateTime, $userId))) {
            $error = "W podanym okresie istnieje już inne zadanie.";
        } else {
            $zadanie = Task::create($title, $description, $startDateTime, $endDateTime);
            $zadanie->addUser($userId);
            $conn->close();
            setcookie("success_message", "Pomyślnie utworzono zadanie", time() + 5, "/");
            header("location: plan-tygodnia.php?date=$taskDate");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/zadanie.css">
    <title>Dodaj zadanie</title>
</head>

<body>
    <div class="container">
        <h1>Dodaj zadanie na dzień <?php echo htmlspecialchars($taskDate); ?></h1>
        <form method="post" action="dodaj-zadanie.php?taskDate=<?php echo htmlspecialchars($taskDate); ?>">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($taskDate); ?>">
            <input type="hidden" name="taskDate" value="<?php echo htmlspecialchars($taskDate); ?>">
            <label for="start_time">Godzina rozpoczęcia</label>
            <input type="time" id="start_time" name="start_time" required>
            <label for="end_time">Godzina zakończenia</label>
            <input type="time" id="end_time" name="end_time" required>
            <label for="title">Tytuł zadania</label>
            <input type="text" id="title" name="title" required>
            <label for="description">Opis</label>
            <textarea id="description" name="description"></textarea>
            <?php if (isset($error)) : ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <button class="buttons-container button" type="submit">Dodaj</button>
        </form>
        <a href="plan-tygodnia.php?date=<?php echo htmlspecialchars($taskDate); ?>" class="back-button">Powrót do planu tygodnia</a>
    </div>
</body>

</html>