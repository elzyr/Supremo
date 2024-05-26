<?php include('top_navbar.php');
require("php/verifyUser.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    $user->logout();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nawigacja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <nav>
        <div class="header">&lt;S&gt;upremo</div>
        <div class="left-nav">
            <ul>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'Eventy.php') echo 'class="active"'; ?>><a href="Eventy.php"><i class="fas fa-calendar-alt"></i> Eventy</a></li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'Kalendarz.php') echo 'class="active"'; ?>><a href="Kalendarz.php"><i class="fas fa-calendar"></i> Kalendarz</a></li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'plan-tygodnia.php') echo 'class="active"'; ?>><a href="plan-tygodnia.php"><i class="fas fa-tasks"></i> Plan tygodnia</a></li>
            </ul>
        </div>
        <div class="right-nav">
            <form method="post" style="display: inline;">
                <button type="submit" name="logout" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Wyloguj</button>
            </form>
        </div>
    </nav>
</body>

</html>