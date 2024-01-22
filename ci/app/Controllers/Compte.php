<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Compte extends BaseController
{
    public function __construct()
    {
    //...
    }
    public function lister()
{
    helper(['form', 'url']);
    $session = session();
    
    if ($session->has('user')) {
        $model = model(Db_model::class);
        $data['titre'] = "Liste de tous les comptes";
        $data['logins'] = $model->get_all_compte();
        $data['total'] = $model->membre();
        return view('templates/haut', $data)
            . view('Views/menu_administrateur')
            . view('affichage_comptes')
            . view('templates/bas');
    } else {
        return redirect()->to(site_url('compte/connecter'));
    }
}

    
    
   
    public function creer()
    {
        helper('form');
        $model = model(Db_model::class);
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod()=="post")
        {
        if (! $this->validate([
            'prenom' => 'required|max_length[255]|min_length[1]',
            'nom' => 'required|max_length[255]|min_length[1]',
            'pseudo' => 'required|max_length[255]|min_length[2]',
            'mdp' => 'required|max_length[255]|min_length[8]',
            'role' => 'required|max_length[1]|min_length[1]'
        ],
        [ // Configuration des messages d’erreurs
            'pseudo' => [
            'required' => 'Veuillez entrer un pseudo pour le compte !',
            ],
            'mdp' => [
            'required' => 'Veuillez entrer un mot de passe !',
            ],
            'mdp' => [
            'min_length' => 'Le mot de passe saisi est trop court !',
            ],74
        ]
            ))
        {
        // La validation du formulaire a échoué, retour au formulaire !
        return view('templates/haut', ['titre' => 'Créer un compte'])
        . view('Views/menu_administrateur')
        . view('compte/creer')
        . view('templates/bas');
        }
        // La validation du formulaire a réussi, traitement du formulaire
        $recuperation = $this->validator->getValidated();
        $model->set_compte($recuperation);
        $data['le_compte']=$recuperation['pseudo'];
        $data['le_message']="Nouveau nombre de comptes : ";
        //Appel de la fonction créée dans le précédent tutoriel :
        $data['le_total']=$model->get_nb_comptes();
        return view('templates/haut', $data)
        . view('Views/menu_administrateur')
        . view('compte/compte_succes')
        . view('templates/bas');
    }
    // L’utilisateur veut afficher le formulaire pour créer un compte
        return view('templates/haut', ['titre' => 'Créer un compte'])
        . view('Views/menu_administrateur')
        . view('compte/creer')
        . view('templates/bas');
    }
    public function connecter()
{
    helper('form');
    $model = model(Db_model::class);

    // L'utilisateur a validé le formulaire en cliquant sur le bouton
    if ($this->request->getMethod() == "post") {
        if (!$this->validate([
            'pseudo' => 'required',
            'mdp' => 'required'
        ])) {
            // La validation du formulaire a échoué, retour au formulaire !
            return view('templates/haut', ['titre' => 'Se connecter'])
                . view('Views/menu_visiteur')
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }

        // La validation du formulaire a réussi, traitement du formulaire
        $username = $this->request->getVar('pseudo');
        $password = $this->request->getVar('mdp');
        $role = $model->get_Role_profil($username);

        if ($model->connect_compte($username, $password) == true) {
            $session = session();
            $session->set('user', ['username' => $username, 'role' => $role->role_cpt]);

            if ($role->role_cpt == "A") {
                return view('templates/haut')
                    . view('Views/menu_administrateur')
                    . view('connexion/compte_accueil', ['session' => $session])
                    . view('templates/bas');
            } else {
                return view('templates/haut')
                    . view('Views/menu_organisateur')
                    . view('connexion/compte_accueil', ['session' => $session])
                    . view('templates/bas');
            }
        } else {
            return view('templates/haut', ['titre' => 'Se connecter'])
                . view('Views/menu_visiteur')
                . view('connexion/compte_connecter')
                . view('templates/bas');
        }
    }

    return view('templates/haut', ['titre' => 'Se connecter'])
        . view('Views/menu_visiteur')
        . view('connexion/compte_connecter')
        . view('templates/bas');
}


public function afficher_profil()
{
    helper('form');
    $session = session();
    if(!$session->has('user')){
        return redirect()->to(base_url('index.php/compte/connecter'));
    }
    if ($session->has('user')) {
        $username = $session->get('user')['username'];

        $model = model(Db_model::class);
        $user_profil = $model->get_user($username);

        // Utilisez directement le modèle pour obtenir le rôle
        $role = $model->get_Role_profil($username)->role_cpt;

        $data['le_message'] = "Affichage des données du profil ici !!!";
        $data['utilisateur'] = $user_profil;

        // Utilisez $role comme nécessaire dans votre vue pour gérer les différents rôles

        // Utilisez $role pour déterminer le menu à afficher
        if ($role == "A") {
            return view('templates/haut', $data)
                . view('menu_administrateur')
                . view('connexion/compte_profil')
                . view('templates/bas');
        } else {
            return view('templates/haut', $data)
                . view('menu_organisateur')
                . view('connexion/compte_profil')
                . view('templates/bas');
        }
    } else {
        // Redirigez l'utilisateur vers la page de connexion
        return redirect()->to(base_url('index.php/compte/connecter'));
    }
}


     
        public function deconnecter()
        {
            $session=session();
            $session->destroy();
            return view('templates/haut', ['titre' => 'Se connecter'])
            . view('menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }
    public function compte_modifier()
    {
        helper('form');
        $session=session();
        if(!$session->has('user')){
            return redirect()->to('compte/connecter');
        }
        
        if ($session->has('user'))
        {
            $model = model(Db_model::class);

            //$user_profil = $model->get_all_compte($session->get('user'));
            $data['le_message']="Modifications du compte ";
            $data['connection'] = $model->get_user_compte($session->get('user'));
        }
    }
    public function modifier_mot_de_passe()
    {
        helper('form');
        $model = model('Db_model');
        $session = session();

        // Vérifiez si l'utilisateur est connecté
        if (!$session->has('user')) {
            return redirect()->to(base_url('compte/connecter'));
        }

        // Initialiser la variable $data
        $data = [];

        // Traitement du formulaire de modification du mot de passe
        if ($this->request->getMethod() == 'post') {
            $new_password = $this->request->getVar('new_password');
            $confirm_password = $this->request->getVar('confirm_password');

            // Vérification de l'ancien mot de passe
            $user = $model->get_user($session->get('user')['username']);
            if ($new_password !== $confirm_password) {
                $data['message'] = 'Les mots de passe ne correspondent pas.';
            } else {
                // Appel de la méthode pour mettre à jour le mot de passe
                $result = $model->update_mot_de_passe($session->get('user')['username'], $new_password);

                if ($result) {
                    return redirect()->to('compte/afficher_profil');
                } else {
                    $data['message'] = 'Échec de la mise à jour du mot de passe.';
                }
            }
        }

    // Afficher le formulaire de modification du mot de passe
    return view('templates/haut', ['titre' => 'Modifier le mot de passe'])
    .view('menu_organisateur')
        . view('connexion/modifier_mot_de_passe', $data)  // Afficher le formulaire de modification du mot de passe
        . view('templates/bas');
}
// ...

/*
public function compte_ajouter()
{
    helper('form');
    $model = model(Db_model::class);
    $session = session();

    if (!$session->has('user')) {
        return redirect()->to('compte/connecter');
    }

    // L’utilisateur a validé le formulaire en cliquant sur le bouton
    if ($this->request->getMethod() == "post") {
        if (!$this->validate([
            'prenom' => 'required|max_length[255]|min_length[1]',
            'nom' => 'required|max_length[255]|min_length[1]',
            'pseudo' => 'required|max_length[255]|min_length[2]',
            'mdp' => 'required|max_length[255]|min_length[8]',
            'mdp_confirmation' => 'required|matches[mdp]',
            'role' => 'required|max_length[1]|min_length[1]'
        ], [
            'pseudo' => [
                'required' => 'Veuillez entrer un pseudo pour le compte !',
            ],
            'mdp' => [
                'required' => 'Veuillez entrer un mot de passe !',
                'min_length' => 'Le mot de passe saisi est trop court !',
            ],
            'mdp_confirmation' => [
                'required' => 'Veuillez confirmer le mot de passe !',
                'matches' => 'La confirmation du mot de passe ne correspond pas au mot de passe saisi !',
            ],
        ])) {
            // La validation du formulaire a échoué, retour au formulaire !
            return view('templates/haut', ['titre' => 'Créer un compte'])
                . view('Views/menu_administrateur')
                . view('compte/compte_ajouter')
                . view('templates/bas');
        }

        // La validation du formulaire a réussi, traitement du formulaire
        $recuperation = $this->validator->getValidated();
        $model->set_compte($recuperation);
        $data['le_compte'] = $recuperation['pseudo'];
        $data['le_message'] = "Nouveau nombre de comptes : ";
        // Appel de la fonction créée dans le précédent tutoriel :
        $data['le_total'] = $model->get_nb_comptes();
        return view('templates/haut', $data)
            . view('Views/menu_administrateur')
            . view('compte/compte_ajouter')
            . view('templates/bas');
    }

    // L’utilisateur veut afficher le formulaire pour créer un compte
    return view('templates/haut', ['titre' => 'Créer un compte'])
        . view('Views/menu_administrateur')
        . view('compte/compte_ajouter')
        . view('templates/bas');
}
*/
}


    
   


