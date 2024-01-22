<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Accueil;
use App\Controllers\Compte;
use App\Controllers\Actualite; 
use App\Controllers\Scenario; 
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Accueil::afficher');

$routes->get('accueil/afficher', [Accueil::class, 'afficher']);
$routes->get('accueil/afficher/(:segment)', [Accueil::class, 'afficher']);
$routes->get('compte/lister', [Compte::class, 'lister']);
$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);
$routes->get('scenario/lister', [Scenario::class, 'lister']);
$routes->get('scenario/afficher_etape/(:segment)/(:num)', [Scenario::class, 'afficher_etape']);
$routes->get('scenario/afficher_etape/(:segment)/', [Scenario::class, 'afficher_etape']);
$routes->get('scenario/afficher_etape/', [Scenario::class, 'afficher_etape']);
$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);
$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);
$routes->get('scenario/affichage_scenarioCompte', [Scenario::class, 'affichage_scenarioCompte']);
$routes->get('compte/modifier_mot_de_passe/(:num)', [Compte::class, 'modifier_mot_de_passe']);
$routes->post('compte/modifier_mot_de_passe', [Compte::class, 'modifier_mot_de_passe']);
$routes->get('scenario/visualiser_scenario', [Scenario::class, 'visualiser_scenario']);
$routes->get('compte/compte_ajouter', [Compte::class, 'compte_ajouter']);
$routes->post('compte/compte_ajouter', [Compte::class, 'compte_ajouter']);
$routes->get('scenario/scenario_ajouter', [Scenario::class, 'scenario_ajouter']);
$routes->post('scenario/scenario_ajouter', [Scenario::class, 'scenario_ajouter']);
$routes->get('scenario/supprimer_scenario/(:segment)', [Scenario::class, 'supprimer_scenario']);
$routes->get('scenario/afficher_detail_scenario/(:segment)', [Scenario::class, 'afficher_detail_scenario']);
$routes->get('scenario/scenario_suivant/(:segment)/(:num)', [Scenario::class, 'franchir_etape']);
$routes->get('scenario/scenario_suivant/(:segment)/', [Scenario::class, 'franchir_etape']);
$routes->get('scenario/scenario_suivant/', [Scenario::class, 'franchir_etape']);
$routes->post('scenario/scenario_suivant/(:segment)/(:num)', [Scenario::class, 'franchir_etape']);
$routes->post('scenario/finaliser_scenario/(:segment)/(:num)', [Scenario::class, 'finaliser_scenario']);
$routes->post('scenario/finaliser_scenario/(:segment)/', [Scenario::class, 'finaliser_scenario']);
$routes->post('scenario/finaliser_scenario/', [Scenario::class, 'finaliser_scenario']);
$routes->get('scenario/finaliser_scenario/(:segment)/(:num)', [Scenario::class, 'finaliser_scenario']);

?>