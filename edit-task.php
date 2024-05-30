<?php
require("php/verifyUser.php");
require("class/Task.php");
if (!isset($_GET['id'])) {
    setcookie("error_message", "Nie znaleziono zadania!", time() + 5, "/");
    echo '<script type="text/javascript">
       window.history.back();
      </script>';
}

$task = Task::load($_GET['id']);
if ($task == null) {
    echo "Nie znaleziono zadania";
    exit();
}
if (!$task->checkPermission($user->getId())) {
    echo "Nie masz dostępu do tego zadania!";
    exit();
}
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("php/dbConnect.php");
    $tytul = $conn->real_escape_string($_POST['title']);
    $opis = $conn->real_escape_string($_POST['description']);
    $startTime = $conn->real_escape_string($_POST['startDate']);
    $endDate = $conn->real_escape_string($_POST['endDate']);
    $validationResult = validateDates($startTime, $endDate);
    if ($validationResult === true) {
        if ($task->update($tytul, $opis, $startTime, $endDate)) {
            setcookie("update_message", "Pomyślnie zaktualizowano zadanie", time() + 5, "/");
            header("Location: zadanie.php?id=" . $task->getId());
            exit();
        } else {
            $errorMsg = "Wystąpił błąd podczas aktualizacji zadania";
        }
    } else {
        $errorMsg = $validationResult;
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/zadanie.css">
    <title>Edytuj zadanie</title>
</head>

<body>
    <div class="container">
        <h1>Edytuj zadanie</h1>
        <form action="edit-task.php?id=<?php echo $task->getId(); ?>" method="post">
            <label for="tytul">Tytuł:</label>
            <input type="text" id="tytul" name="title" value="<?php echo htmlspecialchars($task->getTitle()); ?>" required>
            <label for="opis">Opis:</label>
            <textarea id="opis" name="description"><?php echo htmlspecialchars($task->getDescription()); ?></textarea>
            <label for="dataRozpoczecia">Data rozpoczęcia:</label>
            <input type="datetime-local" name="startDate" value="<?php echo str_replace(' ', 'T', $task->getStartDate()); ?>" required>
            <label for="dataZakonczenia">Data zakończenia:</label>
            <input type="datetime-local" name="endDate" value="<?php echo str_replace(' ', 'T', $task->getEndDate()); ?>" required>
            <?php if ($errorMsg) : ?>
                <p class="error-msg"><?php echo $errorMsg; ?></p>
            <?php endif; ?>
            <button class="button" type="submit">Zapisz zmiany</button>
        </form>
        <?php
        echo '<a href="zadanie.php?id=' . $task->getId() . '" class="back-button">Powrót do zadania</a>';
        ?>
    </div>
</body>

</html>