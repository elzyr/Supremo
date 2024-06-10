<?php
include_once ("class/User.php");
require_once ('navbar.php');
include_once ("./php/validateInput.php");
require ('php/dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validateInput($_POST['email']);
    $phone = validateInput($_POST['phone']);
    $new_password = validateInput($_POST['new_password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Niepoprawny format e-maila";
    } elseif (!isCorrectPassword($new_password) || !isSpecialChar($new_password)) {
        $error_message = "Hasło musi zawierać co najmniej jedną dużą literę, jedną cyfrę oraz jeden znak specjalny";
    } else {
        require ("./php/dbConnect.php");
        $sql = "SELECT * FROM uzytkownicy WHERE email=? AND nrTelefonu=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        if ($stmt->get_result()->num_rows == 1) {
            $user = new User($email, "");
            $user->changePassword($new_password);
            $success_message = "Hasło zmienione pomyślnie";
        } else {
            $error_message = "Nie znaleziono użytkownika!";
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmień hasło!</title>
    <link rel="stylesheet" href="css/reset-hasla.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
    <main class="container">
        <h2>&lt;S&gt; upremo</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" name="email" required placeholder="E-mail:">
            </div>
            <div class="form-group">
                <input type="text" name="phone" required placeholder="Numer Telefonu:">
            </div>
            <div class="form-group">
                <input type="password" name="old_password" required placeholder="Stare Hasło:">
            </div>
            <div class="form-group">
                <input type="password" name="new_password" required placeholder="Nowe Hasło:">
            </div>
            <?php if (isset($error_message) && !empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php elseif (isset($success_message) && !empty($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn forgot_password">Zmień Hasło</button>
        </form>
    </main>
    <script>
        <?php if (isset($success_message) && !empty($success_message)): ?>
            alert('<?php echo $success_message; ?>');
        <?php endif; ?>
    </script>
</body>

</html>