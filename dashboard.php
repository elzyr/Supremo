<?php
require("php/verifyUser.php"); //automatycznie sprawdza czy uzytkownik jest zalogowany i jesli tak to umozliwia dzialanie na nim

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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