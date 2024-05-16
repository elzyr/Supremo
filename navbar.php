<?php include 'top_navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nawigacja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="navbar.css"> <!-- Nowe połączenie do pliku CSS -->
</head>
<body>
<nav>
    <div class="header">&lt;S&gt;upremo</div>
    <div class="left-nav">
        <ul>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'Eventy.php') echo 'class="active"'; ?>><a href="Eventy.php"><i class="fas fa-calendar-alt"></i> Eventy</a></li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'Kalendarz.php') echo 'class="active"'; ?>><a href="Kalendarz.php"><i class="fas fa-calendar"></i> Kalendarz</a></li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'Plan_tygodnia.php') echo 'class="active"'; ?>><a href="Plan_tygodnia.php"><i class="fas fa-tasks"></i> Plan tygodnia</a></li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'Karta_ocen.php') echo 'class="active"'; ?>><a href="Karta_ocen.php"><i class="fas fa-clipboard-list"></i> Karta ocen</a></li>
        </ul>
    </div>
    <div class="right-nav">
        <a href="login.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
    </div>
</nav>
</body>
</html>
