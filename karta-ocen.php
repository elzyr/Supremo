<?php require('navbar.php');
require('php/verifyUser.php');
require('class/przedmiot.php');
require('php/dbConnect.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karta Ocen</title>
    <link rel="stylesheet" href="css/karta-ocen.css">
</head>

<body>
    <main>
        <?php

        // Get userId from session

        $userId = $user->getId();

        if ($userId) {
            // Create an instance of the Przedmiot class
            $przedmiot = new Przedmiot($conn);

            // Fetch subjects assigned to the user
            $subjects = $przedmiot->getSubjectsByUser($userId);

            // Generate HTML divs
            $html = '';
            $html .= '<div class="subjects">';
            foreach ($subjects as $subject) {
                $html .= '<div class="subject">';
                $html .= '<h2>' . htmlspecialchars($subject['nazwa']) . '</h2>';
                $html .= '<a href="oceny.php?idPrzedmiotu=' . htmlspecialchars($subject['idPrzedmiotu']) . '" class="oceny-button">Oceny</a>';
                $html .= '</div>';
            }

            // Output the generated HTML
            $html .= '</div>';
            echo $html;
        } else {
            echo 'User not found';
        }
        ?>
    </main>
</body>

</html>