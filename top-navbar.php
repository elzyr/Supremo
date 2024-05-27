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
            height: 80px; /* Zmiana wysokości paska nawigacyjnego na 50 pikseli */
            width: calc(100% - 200px); /* Rozciągamy do końca ekranu po odjęciu 200 pikseli */
            margin-left: 200px; /* Początek paska nawigacyjnego od 200 pikseli */
            background-color: #333; /* Kolor tła paska nawigacyjnego */
            color: #fff; /* Kolor tekstu */
            padding: 10px 20px; /* Wewnętrzny padding */
            box-sizing: border-box; /* Uwzględniamy padding w szerokości */
            display: flex; /* Flexbox dla centrowania elementów */
            justify-content: space-between; /* Wyrównanie elementów do lewej i prawej strony */
            align-items: center; /* Wyrównanie elementów w pionie */
        }

        .navbar-brand {
            margin-left: 10px; /* Przesunięcie napisu w prawo o 5 pikseli */
            font-weight: bold; /* Pogrubienie tekstu */
            font-size: 25px; /* Zwiększenie rozmiaru czcionki */
        }

        
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand"><?php echo str_replace('-', ' ', basename($_SERVER['SCRIPT_FILENAME'], ".php")); ?></div>
       
    </div>
</body>
</html>
