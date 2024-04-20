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
    $firstName = validateInput($_POST['name']); // Corrected from 'first_name' to 'name'
    $lastName = validateInput($_POST['last_name']);
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    // Validate inputs
    if (!preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚżŻźŹ ]*$/", $firstName) || !preg_match("/^[a-zA-ZąĄćĆęĘłŁńŃóÓśŚżŻźŹ ]*$/", $lastName)) {
        $error_message = "Podaj poprawne Imie";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Niepoprawny format e-maila";
    } else {
        // Secure password hashing
        $password_hash = md5($password);
        $sql = "INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $email, $password_hash, $firstName, $lastName);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            header("Location: login.php");
            exit;
        } else {
            $error_message = "Błąd, skontaktuj się z pracownikiem.";
        }
    }
    //$stmt->close();
}
$conn->close();
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
                    <i class="fas fa-envelope"></i>
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <div class="label-group">
                    <i class="fas fa-key"></i>
                    <label for="password">Hasło:</label>
                    <input type="password" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Imię:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Nazwisko:</label>
                <input type="text" name="last_name" required>
            </div>

            <?php if (!empty($error_message)) : ?>
                <div class="error_message"><?php echo $error_message; ?></div>
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