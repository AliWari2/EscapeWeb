<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Accueil extends BaseController
{
public function afficher()
{
    $model = model(Db_model::class);
    $data['titre'] = 'Liste de tout les Actualites';
    $data['logins'] = $model->get_all_actualite(); 
    return view('templates/haut' , $data)
        . view('menu_visiteur')
        . view('affichage_accueil')
        . view('templates/bas');
}
}
?>