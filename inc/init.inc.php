<?php
//---------------------- BDD
// Connnexion à la base de données
$host = 'mysql:host=localhost;dbname=iplay'; // le serveur (localhost) et le nom de la BDD (entreprise)
$login = 'root'; // le login de connexion à Mysql
$password = ''; // le mdp de connexion à Mysql (sur xampp et wamp, pas de passe)
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
);

try
{
    $pdo = new PDO($host, $login, $password, $options);
}
catch(PDOException $e)
{
    // Affiche un message d'erreur et on termine le script en cours
    die('🛑 Un problème est survenu lors de la tentative de connexion à la base de données : ' . $e->getMessage());
}
//------------------------------------------- SESSION
// Démarrage de la session
session_start();
//------------------------------------------- CHEMIN
// Création de constante
define("RACINE_SITE", "/iplay/");
//------------------------------------------- VARIABLES
// On initialise la variable contenu vide pour éviter les erreurs
$contenu = '';
//------------------------------------------- AUTRES 
// Ici on inclu le fichier des fonctions
require_once('fonction.inc.php');