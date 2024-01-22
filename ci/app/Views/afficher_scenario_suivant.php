<section class="main-section container">
    <?php if (isset($etape)) { ?>
        <h1 class="page-title"><?= $etape->intitule_eta; ?></h1><br />
        <?php if ($etape->chemin_res != NULL) {
           echo" <img width='450px' src='".base_url().'upload/' . $etape->chemin_res ."'</img>";
            }

         if ($etape->lien_ind != NULL){
            echo "<a href='" .$etape->lien_ind."' target='_blank' class='link link-primary'>Besoin d'aide?</a>";
         }
         echo "</br>";
        

        echo session()->getFlashdata('error');
        echo form_open('/scenario/scenario_suivant/'.$lecode.'/'.$niveau);?>
        <?= csrf_field(); ?>
                <div class="form-group">
                    <input type="text" name="reponse" id="reponse" value="<?= set_value('reponse'); ?>" class="form-control" placeholder="Entrer la réponse" />
                    <p class="text text-danger"><?= validation_show_error('reponse'); ?></p>
                </div>
                <input type="hidden" name="thecode" value="<?php echo $lecode; ?>">
                <input type="hidden" name="niveau" value="<?php echo $niveau; ?>">
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
    <?php }else {
        echo( "<div class='alert alert-danger mt-5' role='alert'>
            <strong>Erreur | </strong>L'information recherchée n'existe pas
        </div>");
    }?>
</section>
