<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Confirmation d'ajout de compte</title>
    <!-- Ajoutez ici vos liens vers les fichiers CSS, Bootstrap, etc. -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
        }

        .confirmation-message {
            margin-top: 20px;
            font-size: 18px;
            color: #007bff;
        }

        .total-message {
            margin-top: 10px;
            font-size: 16px;
            color: #007bff; /* Ajoutez une couleur qui a un bon contraste */
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2>Bravo ! Formulaire rempli, le compte suivant a été ajouté :</h2>

        <!-- Afficher le compte ajouté -->
        <div class="confirmation-message">
            <?php echo $le_compte; ?>
        </div>

        <!-- Afficher le message de confirmation -->
        <div class="confirmation-message">
            <?php echo $le_message; ?>
        </div>

        <!-- Afficher le total -->
        <div class="total-message">
             <?php echo $le_total->nb; ?>
        </div>
    </div>

    <!-- Ajoutez ici vos scripts JavaScript, Bootstrap, etc. -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
