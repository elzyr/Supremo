<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karta Ocen</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: whitesmoke;
            font-family: 'Inter', sans-serif;
        }

        .subjects {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            margin-left: 225px;
        }

        .subject {
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

        .subject h2 {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #3180C9;
        }

        .oceny-button {
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
            height: 50%;
            width: 10%;
            box-shadow: 0 3px 4px #BBB;
        }

        .oceny-button:hover {
            background-color: #3180C9;
        }
    </style>
</head>

<body>
    <main>
        <?php
        require_once './php/dbConnect.php';
        require_once './class/uzytkownik.php';
        require_once './class/przedmiot.php';

        // Commented 'cause i need to check if db works

        /*
    // Create an instance of the User class
    
    $user = new Uzytkownik($conn);

    // Define the user's email (this can be retrieved from session, form, etc.)
    $userEmail = 'example@example.com';

    // Fetch user ID based on email
    $idUzytkownika = $user->getUserIdByEmail($userEmail);
    */
        $idUzytkownika = 248658;
        if ($idUzytkownika) {
            // Create an instance of the Przedmiot class
            $przedmiot = new Przedmiot($conn);

            // Fetch subjects assigned to the user
            $subjects = $przedmiot->getSubjectsByUser($idUzytkownika);

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