<?php

namespace App\Models;

use CodeIgniter\Model;

class Db_model extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect(); // Charger la base de données
        // ou
        // $this->db = \Config\Database::connect();
    }

    /* Fonctions membres de gestion des comptes */

    /**
     * Récupère tous les logins des comptes.
     */
    public function get_all_compte()
    {
        // Utilisation de guillemets simples autour de la valeur de l'adresse e-mail
        $requete = "SELECT * FROM t_compte_cpt ORDER BY  etat_cpt='A' ;";
        
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    /**
     * Récupère les détails d'une actualité par son numéro.
     *
     * @param int $numero Numéro de l'actualité.
     * @return array|null Résultat de la requête.
     */
    public function get_actualite($numero)
    {
        $requete = "SELECT * FROM t_actualita_act WHERE id_act=" . $numero . ";";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    /**
     * Récupère le nombre total de membres.
     *
     * @return array|null Résultat de la requête.
     */
    public function membre()
    {
        $requete1 = "SELECT COUNT(*) as nb FROM t_compte_cpt;";
        $result = $this->db->query($requete1);
        return $result->getRow();
    }

    /**
     * Récupère les détails de toutes les actualités récentes.
     *
     * @return array Résultat de la requête.
     */
    public function get_all_actualite()
    {
        $resultat = $this->db->query("SELECT intitule_act,desc_act,date_act,CONCAT(nom_cpt,' ', prenom_cpt) as Auteur FROM t_actualita_act join t_compte_cpt using(id_cpt) where etat_act='A'
        ORDER BY date_act DESC LIMIT 5;");
        return $resultat->getResultArray();
    }

    /**
     * Récupère les détails de tous les scénarios actifs.
     *
     * @return array Résultat de la requête.
     */
    public function get_all_scenario()
    {
        $resultat = $this->db->query("SELECT id_sce,intitule_sce, image_sce,login_cpt,code_sce,etat_sce FROM t_scenario_sce join t_compte_cpt using(id_cpt) WHERE etat_sce='A';
        ");
        return $resultat->getResultArray();
    }

    /**
     * Récupère les détails de tous les scénarios avec le nombre d'étapes.
     *
     * @return array Résultat de la requête.
     */
    public function get_al_scenario()
{
    $resultat = $this->db->query("
        SELECT
            t_scenario_sce.id_sce,
            t_scenario_sce.intitule_sce,
            t_compte_cpt.login_cpt,
            t_scenario_sce.image_sce,
            t_scenario_sce.code_sce,
            t_scenario_sce.etat_sce,
            COUNT(t_etape_eta.ordre_eta) AS nombre_etapes
        FROM
            t_scenario_sce
        LEFT JOIN
            t_compte_cpt ON t_scenario_sce.id_cpt = t_compte_cpt.id_cpt
        LEFT JOIN
            t_etape_eta ON t_scenario_sce.id_sce = t_etape_eta.id_sce
        GROUP BY
            t_scenario_sce.id_sce;
    ");

    return $resultat->getResultArray();
}

    /**
     * Récupère les détails de la première étape d'un scénario à un niveau donné.
     *
     * @param string $code Code du scénario.
     * @param int $niveau Niveau de l'étape.
     * @return array|null Résultat de la requête.
     */
    public function get_scenario_etape($code, $niveau)
    {
        $resultat = $this->db->query("SELECT code_eta ,desc_eta,desc_ind ,lien_ind ,intitule_eta,code_sce,chemin_res
        FROM t_scenario_sce join t_etape_eta USING(id_sce) join t_ressource_res using(id_res)
        LEFT JOIN t_indice_ind ON t_etape_eta.id_eta = t_indice_ind.id_eta AND niveau_ind = $niveau
        
        WHERE code_sce ='$code' AND ordre_eta = 1 ;
        ");
        return $resultat->getRow();
    }

    /**
     * Récupère le nombre total de comptes.
     *
     * @return array|null Résultat de la requête.
     */
    public function get_nb_comptes()
    {
        $resultat = $this->db->query("SELECT COUNT(*) as nb FROM t_compte_cpt;");
        return $resultat->getRow();
    }

    /**
     * Insère un nouveau compte dans la base de données.
     *
     * @param array $saisie Données du formulaire.
     * @return bool Résultat de la requête d'insertion.
     */
    public function set_compte($saisie)
    {
        // Récupération (+ traitement si nécessaire) des données du formulaire
        $nom = htmlspecialchars(addslashes($saisie['nom']));
        $prenom = htmlspecialchars(addslashes($saisie['prenom']));
        $login = $saisie['pseudo'];
        $mot_de_passe = $saisie['mdp'];
        $hashed_password = hash('sha256', $mot_de_passe);
        $role = $saisie['role'];
        $sql = "INSERT INTO t_compte_cpt (id_cpt,mdp_cpt,role_cpt,login_cpt,nom_cpt,prenom_cpt,etat_cpt)VALUES(NULL,'" . $hashed_password . "','" . $role . "','" . $login . "','" . $nom . "','" . $prenom . "','A');";
        return $this->db->query($sql);
    }

    /**
     * Insère un nouveau scénario dans la base de données.
     *
     * @param array $saisie Données du formulaire.
     * @param string $fichier Nom du fichier.
     * @param int $id ID de l'utilisateur.
     * @return bool Résultat de la requête d'insertion.
     */
    public function set_scenario($saisie, $fichier, $id)
    {
        $intitule = htmlspecialchars(addslashes($saisie['intitule']));
        $etat = $saisie['etat'];
    
        // Générer un code aléatoire de 8 caractères
        $code_sce = bin2hex(random_bytes(4));
    
        $sql = "INSERT INTO t_scenario_sce (id_sce, intitule_sce, etat_sce, code_sce, id_cpt, image_sce) VALUES (NULL, '".$intitule."', '".$etat."', '".$code_sce."', '".$id."', '".$fichier."')";
                
        $result = $this->db->query($sql);
    
        return $result;
    }

    /**
     * Supprime un scénario de la base de données.
     *
     * @param int $id ID du scénario.
     * @return bool Résultat de la requête de suppression.
     */
    public function supprimer_scenario($id)
    {
        $sql = "CALL delete_scenario($id)";
        return $this->db->query($sql);
    }

    /**
     * Vérifie si les informations de connexion sont correctes.
     *
     * @param string $u Nom d'utilisateur.
     * @param string $p Mot de passe.
     * @return bool True si les informations sont correctes, sinon False.
     */
    public function connect_compte($u, $p)
    {
        $mot_de_passe = $p;
        $hashed_password = hash('sha256', $mot_de_passe);
        $sql="SELECT login_cpt,mdp_cpt
        FROM t_compte_cpt
        WHERE login_cpt ='".$u."'
        AND mdp_cpt='".$hashed_password."';";
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Récupère les détails d'un utilisateur par son nom d'utilisateur.
     *
     * @param string $user Nom d'utilisateur.
     * @return array|null Résultat de la requête.
     */
    public function get_user_compte($user)
    {
        // Utilisation de requête préparée
        $requete = "SELECT * FROM t_compte_cpt WHERE login_cpt = '".$user."';";
        $resultat = $this->db->query($requete);
        
        // Retourne la première ligne du résultat
        return $resultat->getRow();
    }

    /**
     * Récupère le rôle d'un utilisateur par son nom d'utilisateur.
     *
     * @param string $user Nom d'utilisateur.
     * @return array|null Résultat de la requête.
     */
    public function get_Role_profil($user)
    {
        $requete="SELECT * FROM t_compte_cpt WHERE login_cpt = '" .$user ."';";
        $resultat= $this->db->query($requete);
        return $resultat->getRow();
    }

    /**
     * Met à jour le mot de passe d'un utilisateur.
     *
     * @param string $username Nom d'utilisateur.
     * @param string $new_password Nouveau mot de passe.
     * @return bool Résultat de la requête de mise à jour.
     */
    public function update_mot_de_passe($username, $new_password) {
        $hashed_password = hash('sha256',$new_password);
        $requete = "UPDATE t_compte_cpt SET mdp_cpt = '".$hashed_password."'  WHERE login_cpt='".$username."';";
        $resultat = $this->db->query($requete);
        return $resultat;
    }

    /**
     * Récupère le rôle d'un utilisateur.
     *
     * @param string $user Nom d'utilisateur.
     * @return array|null Résultat de la requête.
     */
    public function get_role($user)
    {
        $requete = "SELECT login_cpt FROM t_compte_cpt WHERE role_cpt = '" . $user . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    /**
     * Récupère l'ID d'un utilisateur.
     *
     * @param string $user Nom d'utilisateur.
     * @return array|null Résultat de la requête.
     */
    public function get_id($user)
    {
        $requete = "SELECT login_cpt FROM t_compte_cpt WHERE id_cpt = '" . $user . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    /**
     * Récupère les détails d'un utilisateur.
     *
     * @param string $user Nom d'utilisateur.
     * @return array|null Résultat de la requête.
     */
    public function get_user($user) {
        $requete = "SELECT id_cpt, nom_cpt, prenom_cpt, login_cpt, role_cpt FROM t_compte_cpt WHERE login_cpt = '".$user."';";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    /**
     * Récupère les détails d'un scénario.
     *
     * @param string $code Code du scénario.
     * @return array|null Résultat de la requête.
     */
    public function get_scenario_detail($code)
    {
        $resultat = $this->db->query("SELECT * FROM t_scenario_sce join t_compte_cpt using(id_cpt) join t_etape_eta using(id_sce) left join t_ressource_res using(id_res) WHERE code_sce='".$code."' ;");
        return $resultat->getRow();
    }

    /**
     * Récupère les détails d'une étape d'un scénario à un niveau donné.
     *
     * @param string $code Code de l'étape.
     * @param int $niveau Niveau de l'étape.
     * @return array|null Résultat de la requête.
     */
    public function get_etape($code, $niveau){
        $resultat= $this->db->query("SELECT *
        FROM t_etape_eta
        LEFT JOIN t_ressource_res USING (id_res)
        LEFT JOIN t_indice_ind ON t_etape_eta.id_eta = t_indice_ind.id_eta
        AND niveau_ind = '".$niveau."' where code_eta = '".$code."';");
        return $resultat->getRow();
    }

    /**
     * Récupère les détails d'une étape de réponse.
     *
     * @param string $code_hache Code de l'étape haché.
     * @return array|null Résultat de la requête.
     */
    public function get_etape_reponse($code_hache){
        $requetes="SELECT * FROM t_etape_eta LEFT JOIN t_scenario_sce USING(id_sce) WHERE code_eta ='".$code_hache."';";
        $resultat=$this->db->query($requetes);
        return $resultat->getRow();
    }
/**
 * Récupère le code de la prochaine étape d'un scénario à un niveau donné.
 *
 * @param int $idsce ID du scénario.
 * @param int $niv Niveau de l'étape.
 * @return array|null Résultat de la requête.
 */
public function getNextCode($idsce, $niv)
{
    $query = "SELECT code_eta FROM t_etape_eta WHERE id_sce = '".$idsce."' AND ordre_eta = '".($niv + 1)."';";

    $resultat = $this->db->query($query);
    return $resultat->getRow();
}

/**
 * Insère un nouveau participant dans la base de données.
 *
 * @param string $mail Adresse e-mail du participant.
 * @return bool Résultat de la requête d'insertion.
 */
public function insertionParticipant($mail)
{
    $requetes = "INSERT INTO t_participant_par VALUES(null, '".$mail."');";
    $resultat = $this->db->query($requetes);
    return $resultat;
}

/**
 * Récupère l'ID d'un participant par son adresse e-mail.
 *
 * @param string $mail Adresse e-mail du participant.
 * @return array|null Résultat de la requête.
 */
public function getParticipant($mail)
{
    $requetes = "SELECT id_par FROM t_participant_par WHERE adresse_par='".$mail."';";
    $resultat = $this->db->query($requetes);
    return $resultat->getRow();
}

/**
 * Crée un enregistrement de réussite pour un participant dans un scénario à un niveau donné.
 *
 * @param string $sce Code du scénario.
 * @param int $niveau Niveau de réussite.
 * @param int $id ID du participant.
 * @return bool Résultat de la requête d'insertion.
 */
public function createReussite($sce, $niveau, $id)
{
    $requete = "INSERT INTO t_reussite_res VALUES ('".$sce."', '".$id."', NOW(), NOW(), '".$niveau."');";
    $resultat = $this->db->query($requete);
    return $resultat;
}

/**
 * Récupère l'ID du scénario par son code.
 *
 * @param string $code Code du scénario.
 * @return array|null Résultat de la requête.
 */
public function getIdsce($code)
{
    $requete = "SELECT id_sce FROM t_scenario_sce WHERE code_sce='".$code."';";
    $resultat = $this->db->query($requete);
    return $resultat->getRow();
}

/*public function get_etape_reponse($code){
    $requete=  $this->db->->query("SELECT * FROM   t_etape_eta ")
}*/         

/*public function get_scenario_detail($code, $niveau)
{
    $resultat = $this->db->query("SELECT desc_eta,desc_ind ,lien_ind ,intitule_eta,code_sce,chemin_res
    FROM t_scenario_sce join t_etape_eta USING(id_sce) join t_ressource_res using(id_res)
    LEFT JOIN t_indice_ind ON t_etape_eta.id_eta = t_indice_ind.id_eta AND niveau_ind = $niveau
    
    WHERE code_sce ='$code' AND ordre_eta = 1 ;
    ");
    return $resultat->getRow();
}
*/

}
