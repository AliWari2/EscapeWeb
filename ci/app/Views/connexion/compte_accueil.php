<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Espace d'administration</title>
    <!-- Ajoutez ici vos liens vers les fichiers CSS, Bootstrap, etc. -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Ajoutez vos styles personnalisés ici */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        .welcome-message {
            text-align: center;
            font-size: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Espace Privé</h2>
        <br />
        <h2 class="welcome-message">Session ouverte ! Bienvenue <?= esc($session->get('user')['username']) ?> !</h2>

    </div>

    <!-- Ajoutez ici vos scripts JavaScript, Bootstrap, etc. -->

    <!-- Ajoutez ici vos scripts JavaScript, Bootstrap, etc. -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
