<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Scenario extends BaseController
{
    public function __construct()
    {
        $this->model = model(Db_model::class);
    }
 /* public function lister()
{
    helper('form');
    $session = session();
    $model = model(Db_model::class);
    $data['titre'] = "Liste de tous les Scenarios";

    if ($session->has('user')) {
        $data['scenarios'] = $model->get_all_scenario();
        return view('templates/haut', $data)
            . view('menu_organisateur')
            . view('affichage_scenario')
            . view('templates/bas');
    } else {
        return view('templates/haut', $data)
            . view('Views/menu_visiteur')
            . view('affichage_accueil')
            . view('templates/bas');
    }
}
*/
public function lister()
{
$model = model(Db_model::class);
 $data['titre']="Liste de tous les comptes";
$data['scenarios'] = $model->get_all_scenario();
//$data['total'] = $model->membre();
return view('templates/haut', $data)
.view('menu_visiteur') 
. view('affichage_scenario')
.view('templates/bas');
} 


    public function afficher_etape($code="" , $niveau=0)
    {
        helper('form');
        $model = model(Db_model::class);
        $etape = $model->get_scenario_etape($code , $niveau);
        
        if($niveau == 0 || $code=="" || $etape == NULL){
            return redirect()->to('/');
        }
        
        $data['etape'] = $etape;
        $data['niveau']=$niveau;
        $data['lecode'] = $data['etape']->code_eta;
            $data['titre'] = 'Données de la première étape';
            return view('templates/haut', $data)
            . view('menu_visiteur') // Inclure le menu visiteur si nécessaire
            . view('afficher_scenario_suivant') // Créez la vue correpsondante
            . view('templates/bas');

        
    }

    public function affichage_scenarioCompte()
{
    helper('form');
    $session = session();
    if(!$session->has('user')){
        return redirect()->to('compte/connecter');
    }
    if ($session->has('user')) {
        $model = model(Db_model::class);

        //$user_profil = $model->get_all_compte($session->get('user'));
        $data['le_message'] = "Affichage des données du profil ici !!!";
        $data['scenario'] = $model->get_Role_profil($session->get('user'));

        return view('templates/haut', $data)
            . view('menu_organisateur')
            . view('affichage_scenarioCompte')
            . view('templates/bas');
    } else {
        return view('templates/haut', ['titre' => 'Se connecter'])
            . view('menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }
}

public function visualiser_scenario()
{
    helper('form');
    $session = session();

    // Vérifie si l'utilisateur est connecté
    if(!$session->has('user')){
        return redirect()->to('index.php/compte/connecter');
    }

    $model = model(Db_model::class);
    $data['titre'] = "Liste de tous les Scenarios";
    $data['logins'] = $model->get_al_scenario();
    $data['user'] = $session->get('user')['username'];

    // Affichage de la vue pour l'utilisateur connecté
    return view('templates/haut', $data)
        . view('menu_organisateur')
        . view('visualiser_scenario')
        . view('templates/bas');
}

    public function scenario_ajouter()
    {
        helper('form');
        $model = model(Db_model::class);
        $session=session();
        if(!$session->has('user')){
            return redirect()->to('compte/connecter');
        }
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod() == "post") {
            if (!$this->validate([
                'intitule' => 'required|max_length[255]|min_length[1]',
                'etat' => 'required|max_length[1]|min_length[1]',
                'fichier' => [
                    'label' => 'Fichier image',
                    'rules' => [
                    'uploaded[fichier]',
                    'is_image[fichier]',
                    'mime_in[fichier,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fichier,1000]',
                    'max_dims[fichier,1024,768]',
                    ]]
            ])) {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut', ['titre' => 'Ajouter un scenario'])
                    . view('Views/menu_organisateur')
                    . view('scenario_ajouter')
                    . view('templates/bas');
            }
    
            // La validation du formulaire a réussi, traitement du formulaire
            $recuperation = $this->validator->getValidated();
            $fichier=$this->request->getFile('fichier');
            if(!empty($fichier)){
            // Récupération du nom du fichier téléversé
                $nom_fichier=$fichier->getName();
                // Dépôt du fichier dans le répertoire ci/public/images
                if($fichier->move("upload",$nom_fichier)){
                // + Mettre ici l’appel de la fonction membre du Db_model
                // + L’affichage de la page indiquant l’ajout du compte !
                }
            }
            $id=$model->get_user($session->get('user')['username']);
            $model->set_scenario($recuperation,$nom_fichier,$id->id_cpt);

            //$data['le_compte'] = $recuperation['pseudo'];
            //$data['le_message'] = "Nouveau nombre de comptes : ";
            
            //Appel de la fonction créée dans le précédent tutoriel :
            //$data['le_total']=$model->get_nb_comptes();
            
            // Redirection après l'ajout du scénario
            return redirect()->to('/scenario/visualiser_scenario');
        }
    
        // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut', ['titre' => 'Ajouter un scenario'])
            . view('Views/menu_organisateur')
            . view('scenario_ajouter')
            . view('templates/bas');
    }
    public function supprimer_scenario($code)
    {
        // Vérifiez si le code du scénario est fourni
        if (empty($code)) {
            // Si le code n'est pas fourni, redirigez vers une page d'erreur ou une page par défaut
            return redirect()->to('/scenario/visualiser_scenario'); // Remplacez cela par l'URL appropriée
        }
        $model = model(Db_model::class);
    
        // Supprimez le scénario sans vérifier son existence préalable
        $model->supprimer_scenario($code);
    
        // Redirigez automatiquement après la suppression
        return redirect()->to('/scenario/visualiser_scenario');
    }
    
    
/*public function afficher_detail_scenario($code = "")
{
    $model = model(Db_model::class);
    $data['scenario'] = $model->get_scenario_detail($code);
        $data['titre'] = 'Detail du scenario';
        return view('templates/haut', $data)
        . view('menu_organisateur') // Inclure le menu visiteur si nécessaire
        . view('affichage_detail_scenario') // Créez la vue correpsondante
        . view('templates/bas');   
}*/
    


public function afficher_detail_scenario($code="" , $niveau=0)
{
    $model = model(Db_model::class);
 
    $data['scenario'] = $model->get_scenario_detail($code , $niveau);

   // $data['niveau']=$niveau;
        $data['titre'] = 'Données de la première étape';
        return view('templates/haut', $data)
        . view('menu_organisateur') // Inclure le menu visiteur si nécessaire
        . view('affichage_detail_scenario') // Créez la vue correpsondante
        . view('templates/bas');

    
}
public function franchir_etape($code = NULL, $niveau = NULL)
{
    helper('form');

    // L'utilisateur a validé le formulaire
    if ($this->request->getMethod() == 'post') {
        $code_cache = $this->request->getPost('thecode');
        $niveau = $this->request->getPost('niveau');

        if (!$this->validate([
            'reponse' => 'required',
        ] ,[
            'reponse' => [
                'required'=> 'Entrez une reponse ',
            ]
        ])){

            // Check if both $scode_cache and $sniveau are not NULL
            //----------------------------------
            if($code_cache != NULL && $niveau != NULL && $niveau>0 && $niveau <=3){ 
                $data['etape'] = $this->model->get_etape($code_cache, $niveau);
                $data['lecode'] = $code_cache;
                $data['niveau'] = $niveau;
            }else{
                return redirect()->to('/scenario/lister');
            }
            //-------------------------------
            //Redirection vers la liste des scenarios
                return view('templates/haut', ['titre' => 'franchir étape'])
                .view('menu_visiteur.php')
                .view('afficher_scenario_suivant', $data)
                .view('templates/bas');
        }

        // Validation failed, show error message or handle accordingly
        // ...

        // Récuperation de la réponse saisie
        $reponse_saisie = $this->request->getPost('reponse');

        // + code caché (hidden) de l'etape actuelle
        $code_cache = $this->request->getPost('thecode');
        $niveau = $this->request->getPost('niveau');

        // Récupération de la bonne réponse de l'étape actuelle
        $reponse_vrai = $this->model->get_etape_reponse($code_cache);

        // Comparaison des 2 chaînes de réponse
        if ($reponse_saisie == $reponse_vrai->reponse_eta) {
            // On récupère le rang de l'étape en cours
            $ordre_etape = $reponse_vrai->ordre_eta;

            $nextCode = $this->model->getNextCode($reponse_vrai->id_sce, $ordre_etape);

            if ($nextCode == NULL) {
                return redirect()->to('scenario/finaliser_scenario/'.$reponse_vrai->code_sce.'/'.$niveau);
            } 
            return redirect()->to('scenario/scenario_suivant/'. $nextCode->code_eta.'/'.$niveau);
            
        } else {
            //return redirect()->to('scenario/scenario_suivant/'. $code_cache.'/'.$niveau);
        }
    }
        // L'utilisateur veut afficher le formulaire
        //--------------------------
        if($code != NULL && $niveau != NULL && $niveau>0 && $niveau <=3){ 
            $data['etape'] = $this->model->get_etape($code, $niveau);
            $data['lecode'] = $code;
            $data['niveau'] = $niveau;
        }else{
            return redirect()->to('/scenario/lister');
        }
        
            return view('templates/haut', ['titre' => 'franchir étape'])
                .view('menu_visiteur.php')
                .view('afficher_scenario_suivant', $data)
                .view('templates/bas');
 }
 
 public function finaliser_scenario($code = NULL, $niveau = 0)
{
    helper('form');
    if ( $niveau < 0 || $niveau > 3 || $code == NULL) {
        $data['error'] = "L'information cherchée n'existe pas";
        return view('templates/haut', $data)
            .view('menu_visiteur')
            .('finaliser_scenario.php')
            .('templates/bas');
    }

    if ($this->request->getMethod() == "post") {
        if (!$this->validate([
            'email' => 'required|max_length[255]|min_length[2]|valid_email',
        ],[
            'email'=> [
                'required' => 'Veuillez entrer un mail',
                'min_length' => 'email est trop court',
                'max_length' => 'email trop long',
                'valid_email' => 'entrez un mail valide'
            ]
        ])){
            $data['titre'] = 'Validation du scénario';
            $data['sce'] = $code;
            $data['niveau'] = $niveau;

            return view('templates/haut', $data)
                .view('menu_visiteur')
                .view('finaliser_scenario.php')
                .view('templates/bas');
        }
            $email = $this->request->getPost('email');
            $this->model->insertionParticipant($email);
            $participantV = $this->model->getParticipant($email);
            $idScenario = $this->model->getIdsce($code);
            $this->model->createReussite($idScenario->id_sce, $niveau, $participantV->id_par);
            return redirect()->to('/scenario/lister');

            
        }
        $data['titre'] = 'Validation du scénario';
        $data['sce'] = $code;
        $data['niveau'] = $niveau;

        return view('templates/haut', $data)
            .view('menu_visiteur')
            .view('finaliser_scenario.php')
            .view('templates/bas');
    }
 }