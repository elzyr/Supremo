<?php require('php/dbConnect.php');
require('php/verifyUser.php');
require('class/przedmiot.php');
require('navbar.php');

// Get the subject ID from the query parameter
$idPrzedmiotu = isset($_GET['idPrzedmiotu']) ? intval($_GET['idPrzedmiotu']) : null;

if (!$idPrzedmiotu) {
    echo 'Invalid subject ID.';
    exit();
}

$userId = $user->getId();


// Create an instance of the Przedmiot class
$przedmiot = new Przedmiot($conn);

// Fetch activities and their grades for the user in the specific subject
$grades = $przedmiot->getGradesFromActivity($userId, $idPrzedmiotu);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karta ocen</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: whitesmoke;
            font-family: 'Inter', sans-serif;
        }

        .title {
            margin: 25px 0 0 250px;
            font-family: 'Poppins', sans-serif;
            font-size: 36px;
            color: #000;

        }

        .activities {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            margin-left: 225px;
        }

        .activity {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 20px;
            background-color: #f9f9f9;
            max-width: 80%;
            height: 75px;
            box-shadow: 0 7px 4px #BBB;

        }

        .activity h2 {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #3180C9;
        }

        .activity p {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #000;
            font-size: 30px;
        }

        .go-back-button {
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            padding: 10px 20px;
            background-color: #7372E6;
            color: #fff;
            text-decoration: none;
            border-radius: 71px;
            font-weight: 400;
            width: 10%;
            margin-top: 15px;
            box-shadow: 0 3px 4px #BBB;
        }

        .go-back-button:hover {
            background-color: #3180C9;
        }
    </style>
</head>

<body>
    <main>
        <h1 class="title"><?php echo htmlspecialchars($przedmiot->getTitle($idPrzedmiotu)); ?></h1>
        <?php
        if ($userId) {
            // Create an instance of the Przedmiot class
            $przedmiot = new Przedmiot($conn);

            // Fetch subjects assigned to the user
            $subjects = $przedmiot->getSubjectsByUser($userId);

            // Generate HTML divs
            $html = '';
            $html .= '<div class="activities">';

            foreach ($grades as $grade) {
                $html .= '<div class="activity">';
                $html .= '<h2>' . htmlspecialchars($grade['nazwa']) . '</h2>';
                $html .= '<p>' . htmlspecialchars($grade['ocena']) . '</p>';
                $html .= '</div>';
            }
            $html .= '<a class="go-back-button" onclick="window.history.back()"><- Wstecz</a>';
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