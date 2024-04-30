<?php
include("class/uzytkownik.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((Uzytkownik::loadFromSession()) == null) {
        header('Location: login.php');
    }

    $user->logout();
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tmepfile</title>
</head>

<body>
    <form method="post">
        <button type="submit" class="btn btn-login">Wyloguj</button>
    </form>
</body>

</html>