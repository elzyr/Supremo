<?php 
require_once './php/dbConnect.php';
require('navbar.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM zadania WHERE idZadania = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        echo "Brak eventu.";
        exit;
    }
} else {
    echo "Brak Id eventu.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['tytul']); ?></title>
    <link rel="stylesheet" href="css/event-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-tfRBUK1YTCVp86m6l9/2TJBy2rLi9O/8P6FFa3K6ZJ36Zihrvr5vNcLhE3CtIhwKRee0H5PTwMvXXoiqZ2P8dg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="content">
        <div class="image">
            <?php 
            $title = htmlspecialchars($event['tytul']);
            $imagePath = './images/' . $title . '.jpg';
            if (file_exists($imagePath)) {
                echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . $title . '">';
            } else {
                echo '<img src="./images/default.jpg" alt="Placeholder">';
            }
            ?>
        </div>
        <h1><?php echo htmlspecialchars($event['tytul']); ?></h1>
        <p><strong><?php echo date('Y-m-d', strtotime($event['dataRozpoczecia'])) . ' - ' . date('Y-m-d', strtotime($event['dataZakonczenia'])); ?></strong></p>
        <p><strong>Godzina Rozpoczenia:</strong> <strong><?php echo date('H:i', strtotime($event['dataRozpoczecia'])); ?></strong></p>
        <p><?php echo htmlspecialchars($event['opis']); ?></p>

        <div class="button-container">
            <?php 
            $nextId = $id + 1;
            $nextEventSql = "SELECT * FROM zadania WHERE idZadania = $nextId";
            $nextEventResult = $conn->query($nextEventSql);
            
            if ($nextEventResult->num_rows > 0) {
                echo '<a href="event-detail.php?id=' . $nextId . '" class="button">Następne wydarzenie <i class="fas fa-arrow-right" style="margin-left: 5px;"></i></a>';
            } else {
                $firstEventSql = "SELECT * FROM zadania ORDER BY idZadania ASC LIMIT 1";
                $firstEventResult = $conn->query($firstEventSql);
                $firstEvent = $firstEventResult->fetch_assoc();
                $firstId = $firstEvent['idZadania'];
                echo '<a href="event-detail.php?id=' . $firstId . '" class="button">Następne wydarzenie <i class="fas fa-arrow-right" style="margin-left: 5px;"></i></a>';
            }
            ?>
        </div>
    </div>
</body>
</html>
