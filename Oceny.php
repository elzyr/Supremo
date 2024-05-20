<?php include 'navbar.php';

require_once './php/dbConnect.php';
require_once './class/uzytkownik.php';
require_once './class/przedmiot.php';

/*
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

$idUzytkownika = $_SESSION['user_id'];
*/

$idUzytkownika = 248658; // Temporary user ID

// Get the subject ID from the query parameter
$idPrzedmiotu = isset($_GET['idPrzedmiotu']) ? intval($_GET['idPrzedmiotu']) : null;

if (!$idPrzedmiotu) {
    echo 'Invalid subject ID.';
    exit();
}


// Create an instance of the Przedmiot class
$przedmiot = new Przedmiot($conn);

// Fetch activities and their grades for the user in the specific subject
$grades = $przedmiot->getGradesFromActivity($idUzytkownika, $idPrzedmiotu);
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

        .header {
            background-color: #3180C9;
            font-weight: 400;
            font-size: 34px;
        }

        .left-nav {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            line-height: 27px;
        }

        .right-nav {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }

        .logout-btn .fas {
            margin-right: 15px;
        }

        .navbar {
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            color: #000;
            margin-left: 30px;
            font-weight: 600;
            font-size: 26px;
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
    </style>
</head>

<body>
    <h1 class="title"><?php echo htmlspecialchars($przedmiot->getTitle($idPrzedmiotu)); ?></h1>
    <?php
    if ($idUzytkownika) {
        // Create an instance of the Przedmiot class
        $przedmiot = new Przedmiot($conn);

        // Fetch subjects assigned to the user
        $subjects = $przedmiot->getSubjectsByUser($idUzytkownika);

        // Generate HTML divs
        $html = '';
        $html .= '<div class="activities">';

        foreach ($grades as $grade) {
            $html .= '<div class="activity">';
            $html .= '<h2>' . htmlspecialchars($grade['nazwa']) . '</h2>';
            $html .= '<p>' . htmlspecialchars($grade['ocena']) . '</p>';
            $html .= '</div>';
        }

        // Output the generated HTML
        $html .= '</div>';
        echo $html;
    } else {
        echo 'User not found';
    }
    ?>
</body>

</html>