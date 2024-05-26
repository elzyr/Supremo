<?php
include("class/User.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isCorrectName($_POST['name']) || !isCorrectName($_POST['last_name'])) {
        $error_message = "Podaj poprawne Imie";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_message = "Niepoprawny format e-maila";
    } else {
        $user = new User($_POST['email'],  $_POST['password']);
        if ($user->create($_POST['name'], $_POST['last_name'], $_POST['phone']) == true) {
            $error_message = 'Konto stworzone pomyślnie!';
            header('Location: login.php');
        } else {
            $error_message = 'Konto o podanym adresie email już istnieje!';
        }
    }
}

?>

<!DOCTYPE html>
<html>


<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dołącz już dziś!</title>
    <link rel="stylesheet" href="css/forms.css" />
</head>

<body>

    <div class="background-blur"></div>

    <div class="container">
        <h2>&lt;S&gt; upremo</h2>
        <form method="post" class="registration" id="login-form">
            <div class="form-group">
                <input type="text" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required placeholder="E-mail:">
            </div>
            <div class="form-group">
                <input type="password" name="password" required placeholder="Hasło:">
            </div>
            <div class="form-group">
                <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required placeholder="Imię:">
            </div>
            <div class="form-group">
                <input type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>" required placeholder="Nazwisko:">
            </div>
            <div class="form-group">
                <input type="text" name="phone" required pattern="[0-9]{9}" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" required placeholder="Numer Tel:"><br>
            </div>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-register">Stwórz Konto</button>
            <a href="login.php">
                <button type="button" class="btn btn-login">Zaloguj się</button>
            </a>
        </form>
    </div>



</body>

</html>