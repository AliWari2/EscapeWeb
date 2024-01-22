<!-- Ajoutez ici vos liens vers les fichiers CSS, Bootstrap, etc. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un scénario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-dark">Ajouter un scénario</h2>

    <?= session()->getFlashdata('error') ?>

    <?= form_open_multipart('scenario/scenario_ajouter'); ?>
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="intitule" class="text-dark">Intitulé :</label>
        <input type="text" name="intitule" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="etat" class="text-dark">État :</label>
        <input type="text" name="etat" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="fichier">Image pour le profil : </label>
        <input type="file" name="fichier">
    </div>
    <button type="submit" class="btn btn-success">Ajouter le scénario</button>
    </form>
</div>

<!-- Ajoutez ici vos scripts JavaScript, Bootstrap, etc. -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
