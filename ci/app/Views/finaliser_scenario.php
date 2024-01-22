<section class="main-section container">
<?php

        echo session()->getFlashdata('error');
        echo form_open('scenario/finaliser_scenario/'.$sce.'/'.$niveau);?>
        <?= csrf_field(); ?>
                <div class="form-group">
                    <input type="text" name="email" id="reponse" value="<?= set_value('email'); ?>" class="form-control" placeholder="Entrer la réponse" />
                    <input type ="submit" value ='Valider'/>
                    <p class="text text-danger"><?= validation_show_error('email'); ?></p>
                </div>
            </form>
</section>
