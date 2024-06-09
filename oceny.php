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
$idAktywnosci = $przedmiot->getNextActivityId();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nazwa'])) {
    $nazwa = trim($_POST['nazwa']);
    if (!empty($nazwa)) {
        $przedmiot->addActivity($idPrzedmiotu, $nazwa, $idAktywnosci);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ocena'])) {
    $nazwa = trim($_POST['nazwa']);
    $ocena = intval($_POST['ocena']);
    if (!empty($nazwa) && $ocena >= 1 && $ocena <= 5) {
        $przedmiot->addGrade($userId, $idPrzedmiotu, $idAktywnosci, $ocena);
        header("Location: oceny.php?idPrzedmiotu=$idPrzedmiotu");
        exit;
    }
}
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

            $html .= '<div class="hidden-new-activity new-activity">';
            $html .= '<form method="POST" action="">';
            $html .= '<input type="text" name="nazwa" id="nazwa" placeholder="Nazwa aktywności">';
            $html .= '<input type="number" name="ocena" id="ocena" placeholder="Ocena">';
            $html .= '<button type="submit" id="add-activity-to-db">Dodaj</button>';
            $html .= '</form>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="add-activity">';
            $html .= '<a href="#" id="add-activity-button"><i class="fas fa-solid fa-plus"></i>Dodaj aktywność</a>';
            $html .= '</div>';

            $html .= '<a class="go-back-button" onclick="window.history.back()"><i class="fas fa-solid fa-arrow-left"></i>Wstecz</a>';
            $html .= '</div>';
            echo $html;
        } else {
            echo 'User not found';
        }
        ?>
    </main>
    <script>
        document.getElementById('add-activity-button').addEventListener('click', function() {
            var add = document.querySelector('.hidden-new-activity');

            add.classList.remove('hidden-new-activity');
        });
    </script>
</body>

</html>