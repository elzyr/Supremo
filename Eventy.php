<?php 
require_once './php/dbConnect.php';
require('navbar.php');

$sql = "SELECT * FROM zadania";
$events = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="css/eventy.css">
</head>
<body>
    <div class="content">
        <main>
            <?php if ($events->num_rows > 0): ?>
                <?php while($row = $events->fetch_assoc()): ?>
                    <div class="card">
                        <a href="event-detail.php?id=<?php echo $row['idZadania']; ?>">
                            <div class="image">
                                <?php 
                                $title = htmlspecialchars($row['tytul']);
                                $imagePath = './images/' . $title . '.jpg';
                                if (file_exists($imagePath)) {
                                    echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . $title . '">';
                                } else {
                                    echo '<img src="./images/default.jpg" alt="Placeholder">';
                                }
                                ?>
                            </div>
                            <div class="caption">
                                <p><?php echo $title; ?></p>
                                <p><?php echo date('Y-m-d', strtotime($row['dataRozpoczecia'])); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No tasks found.</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
