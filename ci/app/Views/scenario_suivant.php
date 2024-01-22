<div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
            <?php if (!$error) { ?>
                <h2><?= $titre; ?></h2>
                <?= echo session()->getFlashdata('error'); ?>
                <p> Feilicitations vous avez reussi </p>
                <?php echo form_open_multipart('/scenario/scenarion_suivant/' . $sce . '/' . $niveau . '/' . $etape); ?>
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Entrer votre adresse email :</label>
                        <input type="input" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>">
                        <p class="text-danger"><?= validation_show_error('email'); ?></p>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Je valide</button>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger mt-5" role="alert">
            <strong>Erreur :</strong> <?= $error; ?>
        </div>
    <?php } ?>
</div>
