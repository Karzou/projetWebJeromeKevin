<?php

//config pour toute l appli à inclure

//pour voir les erreurs
ini_set('display_errors', 'on');
error_reporting(E_ALL);

class MyAutoload
{
    public static function start()
    {
        //permet de charger automatiquement 
        spl_autoload_register(array(__CLASS__, 'autoload'));

        //definir les variables host et root
        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        define('HOST', $host);
        //define('HOST', 'http://'.$host);       si le premier ne va pas
        define('ROOT', $root);

        //definir constante pour les fichier url
        define('CONTROLLER', ROOT . '/controller/');
        define('MODEL', ROOT . '/model/');
        define('VIEW', ROOT . '/view/');

        //definir constante Bdd
        define('BDD', 'mysql:host=localhost;dbname=projetwebjeromekevin;charset=utf8mb4');
        define('USER_BDD', 'root');
        define('PASSWORD_BDD', '');

        //definir constante pour fichier pc
        define('CSS', 'http://' . HOST . '/assets/css/');
        define('JS', 'http://' . HOST . '/assets/js/');
        define('PUBLIC', ROOT . '/public/');

        // constantes pour les routes
        define('connection', 'index.php?r=connection');
        define('listeEtudiants', 'index.php?r=listeEtudiants');
        define('listeEntreprises', 'index.php?r=listeEntreprises');
        define('encoderEntreprise', 'index.php?r=encoderEntreprise');
        define('infoEtudiant', 'index.php?r=infoEtudiant');
        define('infoStage', 'index.php?r=infoStage');
        define('login', 'index.php?r=login');
        define('logout', 'index.php?r=logout');
        define('insertStudent', 'index.php?r=insertStudent');
        define('insertEntreprise', 'index.php?r=insertEntreprise');
        define('error', 'index.php?r=error');
        define('choixEntreprise', 'index.php?r=choixEntreprise');
        define('index.php', 'index.php?r=index.php');
        define('error404', 'index.php?r=error404');
        define('home', 'index.php?r=home');
    }
    /**
     * Undocumented function
     * Permet d'inclure automatiquement les classes nécéssaires
     * 
     * @param [type] $class
     * @return void
     */
    public static function autoLoad($class)
    {
        if (file_exists(MODEL . $class . '.php')) {
            include_once(MODEL . $class . '.php');
        } elseif (file_exists(CONTROLLER . $class . '.php')) {
            include_once(CONTROLLER . $class . '.php');
        } elseif (file_exists(VIEW . $class . '.php')) {
            include_once(VIEW . $class . '.php');
        };
    }
}