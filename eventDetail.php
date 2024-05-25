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
        echo "Event not found.";
        exit;
    }
} else {
    echo "No event ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['tytul']); ?></title>
    <style>
        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: black;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .content {
            margin-left: 210px; 
            padding: 20px;
        }
        .content .image img {
            width: 100%;
            height: 400px; 
            object-fit: cover;  
            border-radius: 10px;
        }
        .content h1 {
            margin-left: 40px; 
            font-size: 2em;
            margin-bottom: 10px;
        }
        .content p {
            margin-left: 40px; 
            font-size: 1em;
            margin-bottom: 10px;
        }
    </style>
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
    </div>
</body>
</html>
