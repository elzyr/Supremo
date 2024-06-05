<?php require('php/dbConnect.php');
require('php/verifyUser.php');
require('class/przedmiot.php');
require('navbar.php');

$idPrzedmiotu = isset($_GET['idPrzedmiotu']) ? intval($_GET['idPrzedmiotu']) : null;

if (!$idPrzedmiotu) {
    echo 'Invalid subject ID.';
    exit();
}

$userId = $user->getId();


$przedmiot = new Przedmiot($conn);

$grades = $przedmiot->getGradesFromActivity($userId, $idPrzedmiotu);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karta ocen</title>
    <link rel="stylesheet" href="css/oceny.css">
</head>

<body>
    <main>
        <h1 class="title"><?php echo htmlspecialchars($przedmiot->getTitle($idPrzedmiotu)); ?></h1>
        <?php
        if ($userId) {
            $przedmiot = new Przedmiot($conn);

            $subjects = $przedmiot->getSubjectsByUser($userId);

            $html = '';
            $html .= '<div class="activities">';

            foreach ($grades as $grade) {
                $html .= '<div class="activity">';
                $html .= '<h2>' . htmlspecialchars($grade['nazwa']) . '</h2>';
                $html .= '<p>' . htmlspecialchars($grade['ocena']) . '</p>';
                $html .= '</div>';
            }
            
            $html .= '<a class="go-back-button" onclick="window.history.back()"><i class="fas fa-solid fa-arrow-left"></i>Wstecz</a>';
            $html .= '</div>';
            echo $html;
        } else {
            echo 'User not found';
        }
        ?>
    </main>
</body>

</html>