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
        $userId = $user->getId();

        if ($userId) {
            $przedmiot = new Przedmiot($conn);

            $subjects = $przedmiot->getSubjectsByUser($userId);

            $html = '';
            $html .= '<div class="subjects">';
            foreach ($subjects as $subject) {
                $html .= '<div class="subject">';
                $html .= '<h2>' . htmlspecialchars($subject['nazwa']) . '</h2>';
                $html .= '<a href="oceny.php?idPrzedmiotu=' . htmlspecialchars($subject['idPrzedmiotu']) . '" class="oceny-button">Oceny</a>';
                $html .= '</div>';
            }

            $html .= '</div>';
            echo $html;
        } else {
            echo 'User not found';
        }
        ?>
    </main>
</body>

</html>