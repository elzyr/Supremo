<?php
include("class/uzytkownik.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Niepoprawny format e-maila";
    } else {
        require("./php/dbConnect.php");
        $sql = "SELECT * FROM uzytkownicy WHERE email=? AND nrTelefonu=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        if ($stmt->get_result()->num_rows == 1) {
            $user = new Uzytkownik($email, "");
            $user->changePassword($_POST['new_password']);
            header("location: login.php");
        } else {
            $error_message = "Nie znaleziono użytkownika!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przypomnij hasło</title>
    <link rel="stylesheet" href="css/forms.css">
</head>

<body>
    <div class="container">
        <h2>&lt;S&gt; upremo</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" name="email" required placeholder="E-mail:">
            </div>
            <div class="form-group">
                <input type="text" name="phone" required placeholder="Numer Telefonu:">
            </div>
            <div class="form-group">
                <input type="password" name="new_password" required placeholder="Nowe Hasło:">
            </div>
            <?php if (isset($error_message) && !empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="button" class="btn forgot_password">Zmień Hasło</button>
            <a href="login.php">
                <button type="button" class="btn btn-login">Zaloguj się</button>
            </a>
        </form>
    </div>
</body>

</html>