<?php

/**
 * 
 * create routes
 */
class Routeur
{
    private $request;

    /**
     * Undocumented variable
     * tableau qui regroupe toutes les routes => home alors metohode showHome
     * @var array
     */
    private $routes = [
        "home"              => ["controller" => "Controller", "method" => "showHome"],
        "listeEtudiants"    => ["controller" => "Controller", "method" => "showListeEtudiant"],
        "listeEntreprises"  => ["controller" => "Controller", "method" => "showListeEntreprise"],
        "encoderEntreprise" => ["controller" => "Controller", "method" => "showEncoderEntreprise"],
        "infoStage"         => ["controller" => "Controller", "method" => "showInfoEtudiant"],
        "login"             => ["controller" => "Controller", "method" => "showLogin"],
        "logout"            => ["controller" => "Controller", "method" => "showLogout"],
        "insertStudent"     => ["controller" => "Controller", "method" => "addStudentBdd"],
        "insertEntreprise"  => ["controller" => "Controller", "method" => "addEntrepriseBdd"],
        "error"             => ["controller" => "Controller", "method" => "showError"],
        "connection"        => ["controller" => "Controller", "method" => "connection"],
        "choixEntreprise"   => ["controller" => "Controller", "method" => "insertChoixEntreprise"],
        "index.php"         => ["controller" => "Controller", "method" => "showHome"],
        "error404"          => ["controller" => "Controller", "method" => "show404"],
    ];
    /**
     * Undocumented function
     * Constructeur routeur
     * @param [type] $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        session_start();
        if (!isset($_SESSION['attempt'])) {
            $_SESSION['attempt'] = 3;
        }
    }
    /**
     * Undocumented function
     * Ouverture du controller si ok. Si pas==> erreur 404
     * @return void
     */
    public function renderController()
    {
        $request = $this->request;

        //si la route demandée existe
        if (key_exists($request, $this->routes)) {
            $controller = $this->routes[$request]["controller"];
            $method     = $this->routes[$request]["method"];
            $currentController = new $controller();
            $currentController->$method();
        } else {
            // sinon -> route erreur 404
            $controller = "Controller";
            $method = "show404";
            $currentController = new $controller;
            $currentController->$method();
        }
    }
}