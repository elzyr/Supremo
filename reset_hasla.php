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
    <link rel="stylesheet" href="css/przypomnienie_hasla.css">
</head>

<body>
    <div class="container">
        <h2>Przypomnij hasło</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Numer Telefonu:</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nowe Hasło:</label>
                <input type="password" name="new_password" required>
            </div>
            <?php if (isset($error_message) && !empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-login">Zmień Hasło</button>
        </form>
    </div>
</body>

</html>