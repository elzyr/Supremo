<?php
require("php/verifyUser.php");
require("class/Task.php");
if (!isset($_GET['id'])) {
    displayErrorMessage("Nie podano zadania!");;
}

$task = Task::load($_GET['id']);
if ($task == null) {
    displayErrorMessage("Nie znaleziono zadania!");
}
if (!$task->checkUserPermission($user->getId())) {
    displayErrorMessage("Nie masz dostępu do tego zadania!");
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("php/dbConnect.php");
    $tytul = $conn->real_escape_string($_POST['title']);
    $opis = $conn->real_escape_string($_POST['description']);
    $startTime = $conn->real_escape_string($_POST['startDate']);
    $endDate = $conn->real_escape_string($_POST['endDate']);
    $important = isset($_POST['important']) ? 1 : 0;
    $validationResult = validateDates($startTime, $endDate);
    if ($validationResult === true) {
        if ($task->update($tytul, $opis, $startTime, $endDate) && $task->setImportantValue($important, $user->getId())) {
            setcookie("update_message", "Pomyślnie zaktualizowano zadanie", time() + 5, "/");
            header("Location: zadanie.php?id=" . $task->getId());
            exit();
        } else {
            $error = "Wystąpił błąd podczas aktualizacji zadania";
        }
    } else {
        $error = $validationResult;
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
            <label for="important">Ważne</label>
            <input type="checkbox" id="important" name="important" <?php echo $task->isImportant($user->getId()) ? 'checked' : ''; ?>>
            <?php if ($error) : ?>
                <p class="error-msg"><?php echo $error; ?></p>
            <?php endif; ?>
            <button class="button" type="submit">Zapisz zmiany</button>
        </form>
        <?php
        echo '<a href="zadanie.php?id=' . $task->getId() . '" class="back-button">Powrót do zadania</a>';
        ?>
    </div>
</body>

</html>