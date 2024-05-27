<?php include 'top-navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link rel="stylesheet" href="navbar.css"> <!-- Nowe połączenie do pliku CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>  /*nie chce dzialac z plikiem((*/
        body {
            margin: 0;
            background-color: whitesmoke;
        }

        .header {
            background-color: #3180c9;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: 400;
            margin: 0;
            font-size: 34px;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            background-color: #3180c9;
            padding: 10px;
            color: white;
            width: 200px;
            align-items: center;
        }

        nav .left-nav {
            margin-bottom: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            height: 50%;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            line-height: 27px;
            width: 90%;
        }

        .left-nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        nav ul li {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        nav ul li:last-child {
            margin-bottom: 0;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 8px 20px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
            text-align: left;
            flex-wrap: nowrap;
        }

        nav ul li a i {
            margin-right: 10px;
        }

        .logout-btn {
            background-color: white;
            border: 2px solid transparent;
            border-radius: 10px;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            width: 160px;
            box-sizing: border-box;
        }

        .logout-btn .fas {
            margin-right: 15px;
        }

        .brand {
            margin-bottom: auto;
        }

        nav ul li.active a {
            border-color: white;
            background-color: white;
            color: #3180c9;
        }

        .right-nav {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
        }

        .navbar {
            background-color: #fff;
            font-family: "Poppins", sans-serif;
        }

        .navbar-brand {
            color: #000;
            margin-left: 30px;
            font-weight: 600;
            font-size: 26px;
        }

        .collapsed {
            display: none;
        }
    </style>
</head>

<body>
    <nav class="left-navi">
        <div class="header">&lt;S&gt;upremo</div>
        <div class="left-nav">
            <ul>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'Eventy.php')
                    echo 'class="active"'; ?>><a
                        href="Eventy.php"><i class="fas fa-calendar-alt"></i> Eventy</a></li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'Kalendarz.php')
                    echo 'class="active"'; ?>><a
                        href="Kalendarz.php"><i class="fas fa-calendar"></i> Kalendarz</a></li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'plan-tygodnia.php')
                    echo 'class="active"'; ?>><a
                        href="plan-tygodnia.php"><i class="fas fa-tasks"></i> Plan tygodnia</a></li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'karta-ocen.php')
                    echo 'class="active"'; ?>><a
                        href="karta-ocen.php"><i class="fas fa-book"></i> Karta ocen</a></li>
            </ul>
        </div>
        <div class="right-nav">
            <a href="login.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
        </div>
    </nav>
</body>

</html>