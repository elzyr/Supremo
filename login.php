<?php
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'pio';
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);

    $password_hash = md5($password);
    $sql = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password_hash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: https://wp.pl");
        exit;
    } else {
        $error_message = "Nieprawidłowy e-mail lub hasło";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zaloguj się!</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <div class="container">
        <h2>Logowanie</h2>
        <form method="post" action="login.php" id="login-form">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" name="username" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <?php if (isset($error_message) && !empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-login">Zaloguj się</button>
            <a href="rejestracja.php">
                <button type="button" class="btn btn-register" onclick="window.location='rejestracja.php';">Nie masz konta? Zarejestruj się tutaj</button>
            </a>
            <div class="login-recovery">
                <a href="przypomnienie_hasla.php" class="forgot_password">Forgot password?</a>
            </div>
        </form>
    </div>
</body>

</html>