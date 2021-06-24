<?php

/**
 * Classe des vues
 * Undocumented class
 */
class View
{
    private $template;

    /**
     * Constructeur vue
     *
     * @param [type] $template
     */
    public function __construct($template = null)
    {
        $this->template = $template;
    }
    /**
     * Construction de la page client.
     * 
     * @param [type] $params
     * @return void
     */
    public function render($params = null)
    {
        $template = $this->template;

        ob_start();
        include(VIEW . 'pages/' . $template . '.php');
        $contentPage = ob_get_clean();
        include_once(VIEW . '_gabarit.php');
    }
    /**
     * construction de la page de redirection
     *
     * @param [type] $route
     * @return void
     */
    public function redirect($route)
    {

        header("Location: " . $route);
        exit();
    }
    /**
     * construction de la page login
     *
     * @return void
     */
    public function renderLogin()
    {
        include_once(VIEW . 'pages/' . 'login.php');
    }
    /**
     * construction de la page erreur
     *
     * @param [type] $erreur
     * @return void
     */
    public function renderError($erreur, $page)
    {
        include(VIEW . 'pages/' . 'error.php');
    }
    /**
     * construction page 404
     *
     * @return void
     */
    public function render404()
    {
        include(VIEW . 'pages/' . 'error404.php');
    }
}