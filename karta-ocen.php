<?php require('navbar.php');
require('php/verifyUser.php');
require('class/przedmiot.php');
require('php/dbConnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nazwa'])) {
    $nazwa = trim($_POST['nazwa']);
    if (!empty($nazwa)) {
        $przedmiot = new Przedmiot($conn);
        $przedmiot->createPrzedmiot($nazwa, $user->getId(), $przedmiot->getNextIdPrzedmiotu($user->getId()));
        header("Location: karta-ocen.php");
        exit;
    }
}
?>


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
            $html .= '<div class="hidden-new-subject new-subject">';
            $html .= '<form method="POST" action="">';
            $html .= '<input type="text" name="nazwa" id="nazwa" placeholder="Nazwa przedmiotu">';
            $html .= '<button type="submit" id="add-subject-to-db">Dodaj</button>';
            $html .= '</form>';
            $html .= '</div>';
            $html .= '</div>';
            echo $html;
        } else {
            echo 'User not found';
        }
        ?>
        <div class="add-subject">
            <a href="#" id="add-subject-button"><i class="fas fa-solid fa-plus"></i>Dodaj przedmiot</a>
        </div>
    </main>
    <script>
        document.getElementById('add-subject-button').addEventListener('click', function() {
            var add = document.querySelector('.hidden-new-subject');

            add.classList.remove('hidden-new-subject');
        });
    </script>
</body>

</html>