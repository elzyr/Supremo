<?php
include("php/database_utilities.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validateInput($_POST['email']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        header("Location: reset_password.php");
        exit;
    } else {
        $error_message = "Niepoprawny format e-maila";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Przypomnij hasło</title>
    <link rel="stylesheet" href="css/przypomnienie_hasla.css" />
</head>

<body>

    <div class="background-blur"></div>

    <div class="container">
        <h2>Przypomnij hasło</h2>
        <form method="post">
            <div class="form-group">
                <div class="label-group">
                    <i class="fas fa-envelope"></i>
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" required>
                </div>
            </div>
            <?php if (isset($error_message) && !empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-login">Przypomnij hasło</button>
        </form>
    </div>

</body>

</html>
