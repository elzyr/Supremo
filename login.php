<?php
include("class/uzytkownik.php");
$error_message = "";
if (Uzytkownik::loadFromSession()) {
    header('Location: dashboard.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];
    $user = new Uzytkownik($email, $password);
    if (!$user->login()) {
        $error_message = "Niepoprawne dane!";
    } else {
        //tutaj redirect
        header('Location: dashboard.php');
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zaloguj się!</title>
    <link rel="stylesheet" href="css/forms.css" />

</head>

<body>
    <div class="container">
        <h2>&lt;S&gt; upremo</h2>
        <form method="post" action="login.php" id="login-form">
            <div class="form-group">
                <input type="text" name="username" id="email" required placeholder="E-mail">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" required placeholder="Hasło">
            </div>
            <?php if (isset($error_message) && !empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-login">Zaloguj się</button>
            <div class="login-recovery">
                <a href="reset-hasla.php" class="forgot_password">Forgot password?</a>
            </div>
        </form>
    </div>
</body>

</html>