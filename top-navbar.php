<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            height: 80px;
            /* Zmiana wysokości paska nawigacyjnego na 50 pikseli */
            width: calc(100% - 200px);
            /* Rozciągamy do końca ekranu po odjęciu 200 pikseli */
            margin-left: 200px;
            /* Początek paska nawigacyjnego od 200 pikseli */
            background-color: #333;
            /* Kolor tła paska nawigacyjnego */
            color: #fff;
            /* Kolor tekstu */
            box-sizing: border-box;
            /* Uwzględniamy padding w szerokości */
            display: flex;
            /* Flexbox dla centrowania elementów */
            justify-content: flex-start;
            /* Wyrównanie elementów do lewej i prawej strony */
            align-items: center;
            /* Wyrównanie elementów w pionie */
        }

        .navbar-brand {
            margin-left: 10px;
            /* Przesunięcie napisu w prawo o 5 pikseli */
            font-weight: bold;
            /* Pogrubienie tekstu */
            font-size: 25px;
            /* Zwiększenie rozmiaru czcionki */
        }

        .hidden-burger {
            display: none;
        }

        .collapsed-navi {
            display: none;
        }

        .collapsed-main {
            margin-left: 0 !important;
        }

        .collapsed-navbar {
            margin-left: 0 !important;
            width: 100% !important;
        }

        #burger-icon {
            color: #000;
            background-color: whitesmoke;
            border: 1px solid #000;
            width: 40px;
            height: 40px;
            font-weight: bold;
            font-size: 20px;
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <button id="burger-icon" class="btn-burger hidden-burger">&#9776;</button>
        <div class="navbar-brand"><?php echo ucwords(str_replace('-', ' ', basename($_SERVER['SCRIPT_FILENAME'], ".php"))); ?>
        </div>

    </div>
    <script src="toggle-navbar.js"></script>
</body>

</html>