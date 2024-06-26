<?php
function generateGreetingsScript()
{
    echo "
    <script>
        function changeGreeting() {
            var greetings = [
                'CZEŚĆ!',
                'HELLO!',
                'HOLA!',
                'BONJOUR!',
                'CIAO!'
            ];
            var index = document.getElementById('greeting').getAttribute('data-index');
            index = (parseInt(index) + 1) % greetings.length;
            document.getElementById('greeting').textContent = greetings[index];
            document.getElementById('greeting').setAttribute('data-index', index);
        }
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supremo</title>
    <link rel="stylesheet" href="css/strona-poczatkowa.css">
</head>

<body>
    <div class="container">
        <h1>&lt;S&gt; upremo</h1>
        <div class="greetings-box tooltip-top">
            <p id="greeting" class="greeting" data-index="0">CZEŚĆ!</p>
        </div>
        <form method="post" id="form">
            <a href="rejestracja.php">
                <button type="button" class="btn btn-login">Zarejestruj się</button>
            </a>
            <a href="login.php">
                <button type="button" class="btn btn-login">Zaloguj się</button>
            </a>
        </form>
    </div>

    <?php generateGreetingsScript(); ?>

    <script>
        setInterval(changeGreeting, 3000);
    </script>
</body>

</html>