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
    <style>
        body {
            overflow-x: hidden;
        }
        .content * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: black;
        }
        .content html {
            font-size: 62.5%;
        }
        .content main {
            max-width: 1500px;
            width: 95%;
            margin: 30px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            gap: 20px;
            margin-left: 300px; 
        }
        .content main .card {
            max-width: 30%; 
            flex: 1 1 30%;
            flex-shrink: 0;
            text-align: center;
            height: 320px;
            border: 1px solid lightgray;
            margin: 10px; 
            background-color: lightgray; 
            position: relative; 
            border-radius: 20px; 
            overflow: hidden; /* Ensure the image doesn't overflow the card */
        }
        .content main .card .image {
            height: 100%; /* Ensure the image container takes the full height of the card */
        }
        .content main .card .image img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures the image covers the entire container */
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .content main .card .caption {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent background for better readability */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content main .card .caption p {
            margin: 0;
        }
        .content main .card a {
            display: block;
            height: 100%;
            text-decoration: none; 
            color: inherit; 
        }
    </style>
</head>
<body>
    <div class="content">
        <main>
            <?php if ($events->num_rows > 0): ?>
                <?php while($row = $events->fetch_assoc()): ?>
                    <div class="card">
                        <a href="#">
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
    <script src="./toggle-navbar.js"></script>
</body>
</html>
