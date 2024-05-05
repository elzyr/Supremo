<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przekierowanie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #3180C9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 100px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .loading-icon {
            font-size: 50px;
            animation: spin 2s linear infinite;
            position: absolute;
            bottom: 30px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <h1>&lt;S&gt;upremo</h1>
    <div class="loading-icon">
        <i class="fas fa-spinner"></i>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'strona-poczatkowa.php';
        }, 5000);
    </script>
</body>

</html>