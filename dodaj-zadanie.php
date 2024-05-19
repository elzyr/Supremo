<?php
require("php/verifyUser.php");
require('php/dbConnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $conn->real_escape_string($_POST['date']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $startTime = $conn->real_escape_string($_POST['start_time']);
    $endTime = $conn->real_escape_string($_POST['end_time']);
    $userId = $user->getId();

    $query = "INSERT INTO zadania (dataRozpoczecia, dataZakonczenia, tytul, opis)
              VALUES ('$date $startTime', '$date $endTime', '$title', '$description')";
    if ($conn->query($query) === TRUE) {
        $taskId = $conn->insert_id;
        $query = "INSERT INTO zadaniauzytkownikow (idUzytkownika, idZadania) VALUES ('$userId', '$taskId')";
        $conn->query($query);
        header('Location: plan-tygodnia.php');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    $date = $_GET['date'];
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dodaj-zadanie.css">
    <title>Dodaj zadanie</title>
</head>

<body>
    <div class="container">
        <h1>Dodaj zadanie na dzień <?php echo $date; ?></h1>
        <form method="post" action="dodaj-zadanie.php">
            <input type="hidden" name="date" value="<?php echo $date; ?>">
            <label for="title">Tytuł</label>
            <input type="text" id="title" name="title" required>
            <label for="description">Opis</label>
            <textarea id="description" name="description" required></textarea>
            <label for="start_time">Czas rozpoczęcia</label>
            <input type="time" id="start_time" name="start_time" required>
            <label for="end_time">Czas zakończenia</label>
            <input type="time" id="end_time" name="end_time" required>
            <button type="submit">Dodaj</button>
        </form>
        <?php
        echo '<a href="plan-tygodnia.php?date=' . $date . '" class="back-button">Powrót do planu tygodnia</a>';
        ?>
    </div>
</body>

</html>