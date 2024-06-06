<?php require ("php/verifyUser.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/top-navbar.css">
</head>

<body>
    <div class="navbar"> <!--TODO: Cześć, User!-->
        <div class="top-nav-left">
            <button id="burger-icon" class="btn-burger hidden-burger">&#9776;</button>
            <div class="navbar-brand">
                <?php echo ucwords(str_replace('-', ' ', basename($_SERVER['SCRIPT_FILENAME'], ".php"))); ?>
            </div>
        </div>
        <div class="top-nav-right">
            <span id="greet-user">
                <?php if ($user->getName()) {
                    echo "Cześć, " . $user->getName() . "!";
                } else {
                    echo "Jesteś niezalogowany! Co tu robisz?";
                }
                ?>
            </span>
        </div>
    </div>
    <script src="toggle-navbar.js"></script>
</body>

</html>