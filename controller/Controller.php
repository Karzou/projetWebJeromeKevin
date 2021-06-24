<?php

/**
 * Classe du controller "Home"
 * Tout passe par lui	  
 */
class Controller
{
	/**
	 * gère la page d'accueil
	 * 
	 * @return void
	 */
	public function showHome()
	{
		//Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
		if (!isset($_SESSION["iduser"]) && !isset($_SESSION["password"])) {
			header("Location: index.php?r=login");
			exit();
		}

		$manager = new Manager();

		$countStudents = $manager->getCount('etudiants');
		$_SESSION['entreprise'] = $countEnterprise = $manager->getCount('adresse_entreprise');
		$_SESSION['stage'] = $countStage = $manager->getCount('stage');

		$count = [$countStudents, $countEnterprise, $countStage];

		$myView = new View('home');
		$myView->render($count);
	}
	/**
	 * gère la page liste d etudiant
	 *
	 * @return void
	 */
	public function showListeEtudiant()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
		if (!isset($_SESSION["iduser"]) && !isset($_SESSION["password"])) {
			header("Location: login");
			exit();
		}
		$manager = new Manager();
		$etudiants = $manager->getAllStudents();
		$myView = new View('listeEtudiants');
		$myView->render($etudiants);
	}
	/**
	 * gere la page liste entreprise
	 *
	 * @return void
	 */
	public function showListeEntreprise()
	{
		// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
		if (!isset($_SESSION["iduser"]) && !isset($_SESSION["password"])) {
			header("Location: login");
			exit();
		}
		$manager = new Manager();
		if ($entreprises = $manager->getAllEntreprises()) {
			$myView = new View('listeEntreprises');
			$myView->render($entreprises);
		} else {
			$this->showError("Aucune entreprise est enregistrée.", home);
		}
	}
	/**
	 * gère la page login
	 */
	public function showLogin()
	{
		$myView = new View();
		$myView->renderLogin();
	}

	/**
	 * gère la page info de l étudiant
	 *
	 * @return void
	 */
	public function showInfoEtudiant()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
		if (!isset($_SESSION["iduser"]) && !isset($_SESSION["password"])) {
			header("Location: login");
			exit();
		}
		if (isset($_POST['choix'])) {
			$values = $_POST['choix'];
		} else {
			$values = $_SESSION['iddbuser'];
		}

		$manager = new Manager();
		$globalBdd = $manager->getInfoStudent($values);
		if ($globalBdd != false) {
			$myView = new View('infoEtudiant');
			$myView->render($globalBdd);
		} else {
			$this->showError("Vous êtes inscrit à aucun stage ", home);
		}
	}
	/**
	 * gère l'insertion d'entreprise dans la bdd avec retour des erreurs
	 *
	 * @return void
	 */
	public function addEntrepriseBdd()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
		if (!isset($_SESSION["iduser"]) && !isset($_SESSION["password"])) {
			header("Location: login");
			exit();
		}
		try {
			if (!empty($_POST['user_name']) and !empty($_POST['ville'])) {
				$manager = new Manager();
				$nom = ucfirst(strtolower($manager->strToNoAccent(htmlspecialchars($_POST['user_name']))));
				$ville = ucfirst(strtolower($manager->strToNoAccent(htmlspecialchars($_POST['ville']))));
				if ($manager->createEntrepriseBdd($nom, $ville)) {
					$_SESSION['entreprise'] += 1;
					$this->showEncoderEntreprise();
				} else {
					throw new Exception("L'entreprise existe déjà !");
				}
			} else {
				throw new Exception('Veuillez entrez un nom et une ville.');
			}
		} catch (Exception $e) { // S'il y a eu une erreur, alors...
			$error = ($e->getMessage());
			$this->showError($error, encoderEntreprise);
		}
	}
	/**
	 * gère l'insertion d'un nouveu student avec retour d erreur
	 *
	 * @return void
	 */
	public function addStudentBdd()
	{
		try {
			$manager = new Manager();
			if (!empty($_POST['email']) and !empty($_POST['lastname']) and !empty($_POST['user_firstname']) and !empty($_POST['password1']) and !empty($_POST['password2'])) {
				$mail = htmlspecialchars($_POST['email']);
				$nom = ucfirst(strtolower($manager->strToNoAccent(htmlspecialchars($_POST['lastname']))));
				$prenom = ucfirst(strtolower($manager->strToNoAccent(htmlspecialchars($_POST['user_firstname']))));
				$mdp = sha1($_POST['password1']);
				$mdp2 = sha1($_POST['password2']);

				$pseudolength = strlen($nom);
				if ($pseudolength <= 255) {
					if ($mdp == $mdp2) {

						if ($manager->createStudentBdd($mail, $nom, $prenom, $mdp, $mdp2)) {
							$this->showLogin();
						} else {
							throw new Exception("Ce mail est deja utilisé");
						}
					} else {
						throw new Exception("Les mots de passes ne correspondent pas !");
					}
				} else {
					throw new Exception("Le nom encodé est trop long !");
				}
			} else {
				throw new Exception("Tous les champs doivent être complétés !");
			}
		} catch (Exception $e) { // S'il y a eu une erreur, alors...
			$error = ($e->getMessage());
			$this->showError($error, home);
		}
	}
	/**
	 * gère le logout avec destroy et redirection login
	 *
	 * @return void
	 */
	public function showLogout()
	{
		$manager = new Manager;
		$manager->logout();
		$myView = new View();
		$myView->redirect(login);
	}
	/**
	 * gère la validation de connection login
	 *
	 * @return void
	 */
	public function connection()
	{

		$manager = new Manager;

		try {

			if (isset($_POST['Connection'])) {
				$username = trim($_POST['user_name']);
				$password = sha1(trim($_POST['password']));
				if ($username != "" && $password != "") {

					if ($manager->validateLogin($username, $password)) {
						$_SESSION['password'] = $password;
						$_SESSION['iduser']   = $username;
						$_SESSION['attempt'] = 3;
						$this->showHome();
					} else {
						throw new Exception('Votre login ou password est invalide !');
					}
				} else {
					throw new Exception('Tous les champs ne sont pas remplis !');
				}
			} else {
				$this->showLogin();
			}
		} catch (Exception $e) { // S'il y a eu une erreur, alors...
			$error = ($e->getMessage());
			$this->showError($error, login);
		}
	}
	/**
	 * gère la page formulaire encoder entreprise
	 *
	 * @return void
	 */
	public function showEncoderEntreprise()
	{
		// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page de connexion
		if (!isset($_SESSION["iduser"]) && !isset($_SESSION["password"])) {
			header("Location: login");
			exit();
		}
		$myView = new View('encoderStage');
		$myView->render();
	}
	/**
	 * gère l'insertion en bdd du choix de stage avec retour d erreur
	 *
	 * @return void
	 */
	public function insertChoixEntreprise()
	{
		try {
			$manager = new Manager();
			if (!empty($_POST['choix'])) {
				$descriptif = $_POST['sujet'];
				$superviseur = ucfirst(strtolower($manager->strToNoAccent(htmlspecialchars($_POST['superviseur']))));
				$choix = htmlspecialchars($_POST['choix']);
				$iduser = htmlspecialchars($_SESSION['iddbuser']);
				if ($manager->addChoixEntreprise($descriptif, $superviseur, $iduser, $choix)) {
					$this->showListeEntreprise();
				} else {
					throw new Exception("Impossible d'encoder. Vous êtes déjà inscris pour ce stage !");
				}
			} else {
				throw new Exception("Tous les champs doivent etre remplis!");
			}
		} catch (Exception $e) { // S'il y a eu une erreur, alors...
			$error = ($e->getMessage());
			$this->showError($error, listeEntreprises);
		}
	}

	public function showError($message, $page)
	{
		$myView = new View();
		$myView->renderError($message, $page);
	}
	/**
	 * Undocumented function
	 * gère la page 404
	 * @return void
	 */
	public function show404()
	{
		$myView = new View();
		$myView->render404();
	}
}