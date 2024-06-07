<?php require('top-navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>

<body>
    <nav class="left-navi">
        <div id="header">&lt;S&gt;upremo</div>
        <div class="left-nav">
            <ul id="nav-list">
                <li class="nav-list-line <?php if (basename($_SERVER['PHP_SELF']) == 'Eventy.php')
                                                echo ' active'; ?>"><a class="nav-list-line-link" href="Eventy.php"><i class="fas fa-calendar-alt"></i> Eventy</a></li>
                <li class="nav-list-line <?php if (basename($_SERVER['PHP_SELF']) == 'Kalendarz.php')
                                                echo ' active'; ?>"><a class="nav-list-line-link" href="Kalendarz.php"><i class="fas fa-calendar"></i> Kalendarz</a></li>
                <li class="nav-list-line <?php if (basename($_SERVER['PHP_SELF']) == 'plan-tygodnia.php')
                                                echo ' active'; ?>"><a class="nav-list-line-link" href="plan-tygodnia.php"><i class="fas fa-tasks"></i> Plan tygodnia</a></li>
                <li class="nav-list-line <?php if (basename($_SERVER['PHP_SELF']) == 'karta-ocen.php')
                                                echo ' active'; ?>"><a class="nav-list-line-link" href="karta-ocen.php"><i class="fas fa-book"></i> Karta ocen</a></li>
            </ul>
        </div>
        <div class="right-nav">
            <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
        </div>
    </nav>
</body>

</html>