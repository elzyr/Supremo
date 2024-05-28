<?php
require("php/verifyUser.php");
require('class/WeekSchedule.php');
require("class/Task.php");
require("php/dbConnect.php");

if (!isset($_GET['id'])) {
    echo "Nie znaleziono tego zadania";
    exit();
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($task->delete($user->getId())) {
        setcookie("success_message", "Pomyślnie Usunięto zadanie", time() + 5, "/");
        header("Location: plan-tygodnia.php?date=" . $task->getStartDate());
        exit();
    } else {
        echo "Nie udało się usunąć zadania";
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/plan-tygodnia.css">
    <link rel="stylesheet" href="css/zadanie.css">
    <title>Szczegóły zadania</title>
</head>

<body>
    <div class="container">
        <h1>Szczegóły zadania</h1>
        <p><strong>Tytuł:</strong> <?php echo htmlspecialchars($task->getTitle()); ?></p>
        <p><strong>Opis:</strong> <?php echo htmlspecialchars($task->getDescription()); ?></p>
        <p><strong>Data rozpoczęcia:</strong> <?php echo htmlspecialchars($task->getStartDate()); ?></p>
        <p><strong>Data zakończenia:</strong> <?php echo htmlspecialchars($task->getEndDate()); ?></p>

        <div class="buttons-container">
            <a href="edit-task.php?id=<?php echo $task->getId(); ?>" class="button">Edytuj</a>
            <form method="post" onsubmit="return confirm('Czy na pewno chcesz usunąć to zadanie?');">
                <input type="hidden" name="id" value="<?php echo $task->getId(); ?>">
                <button type="submit" class="button button-red">Usuń</button>
            </form>
        </div>
        <?php if (isset($_COOKIE['update_message'])) : ?>
            <p class="success-msg"><?php echo htmlspecialchars($_COOKIE['update_message']); ?></p>
            <?php setcookie("update_message", "", time() - 3600, "/");
            ?>
        <?php endif; ?>
        <a href="plan-tygodnia.php?date=<?php echo $task->getStartDate(); ?>" class="button">Powrót do planu tygodnia</a>
    </div>
</body>

</html>