<?php
include("class/uzytkownik.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isCorrectName($_POST['name']) || !isCorrectName($_POST['last_name'])) {
        $error_message = "Podaj poprawne Imie";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_message = "Niepoprawny format e-maila";
    } else {
        $user = new Uzytkownik($_POST['email'],  $_POST['password']);
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
    <link rel="stylesheet" href="css/rejestracja.css" />
</head>

<body>

    <div class="background-blur"></div>

    <div class="container">
        <h2>Rejestracja</h2>
        <form method="post" class="registration" id="login-form">
            <div class="form-group">
                <div class="label-group">
                    <label name="email">E-mail:</label>
                    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="label-group">
                    <label name="password">Hasło:</label>
                    <input type="password" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <label name="name">Imię:</label>
                <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label name="surname">Nazwisko:</label>
                <input type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label name="phone">Numer telefonu:</label>
                <input type="text" name="phone" required pattern="[0-9]{9}" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>"><br>
            </div>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-login">Rozpocznij!</button>
            <a href="login.php">
                <button type="button" class="btn btn-register">Masz już konto? Zaloguj się!</button>
            </a>
        </form>
        <div class="login-recovery">
            <a href="przypomnienie_hasla.php" class="forgot_password">Forgot password?</a>
        </div>
    </div>



</body>

</html>