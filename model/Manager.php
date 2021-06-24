<?php

/**
 * classe qui gère les appels et entrées en bdd
 */
class Manager
{

    private $bdd;
    /**
     * constructeur avec connection a la bdd
     */
    public function __construct()
    {
        try {
            $this->bdd = new PDO(BDD, USER_BDD, PASSWORD_BDD);
        } catch (PDOException $erreur) {
            $message = '<p>Erreur à la connexion !</p>';
            $myView = new View();
            $myView->renderError($message, "encoderEntreprise");
            die();
        }
    }

    /**
     * retourne le nombre de ?
     *
     * @param [type] $table
     * @return void
     */
    public function getCount($table)
    {
        $bdd = $this->bdd;
        if ($table == 'stage') {
            $req = $bdd->prepare("select * from etudiants join sujet_stage on etudiants.id_etudiant=sujet_stage.num_stagiaire join adresse_entreprise on sujet_stage.num_entreprise=adresse_entreprise.id_entreprise where etudiants.id_etudiant=? ");
            $req->execute(array($_SESSION['iddbuser']));
        } else {
            $query = "SELECT * FROM $table";
            $req = $bdd->prepare($query);
            $req->execute();
        }
        $count = $req->rowCount();
        $req->closeCursor();
        $bdd = null;

        return $count;
    }
    /**
     * recupere tout les etudiants de la bdd
     *
     * @return void
     */
    public function getAllStudents()
    {
        $bdd = $this->bdd;
        $query = ('SELECT * FROM etudiants ORDER BY nom_etudiant');
        $req = $bdd->prepare($query);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $etudiant = new Etudiant();
            $etudiant->setId($row['id_etudiant']);
            $stage = "SELECT * FROM sujet_stage WHERE num_stagiaire=?";
            $res = $bdd->prepare($stage);
            $res->execute(array($etudiant->getId()));
            $count = $res->rowCount();
            $etudiant->setNom($row['nom_etudiant']);
            $etudiant->setPrenom($row['prenom_etudiant']);
            $etudiant->setMail($row['email']);
            $etudiant->setMdp($row['mdp']);
            $etudiant->setMdp2($row['mdp2']);
            $etudiant->setStage($row['stage_ok']);
            $etudiant->setNbrStage($count);
            $etudiants[] = $etudiant;
        }
        $req->closeCursor();
        $bdd = null;

        return $etudiants;
    }
    /**
     * recupere les entreprises de la bdd
     *
     * @return void
     */
    public function getAllEntreprises()
    {
        $bdd = $this->bdd;
        $query = ('SELECT * FROM adresse_entreprise ORDER BY nom_entreprise');
        $req = $bdd->prepare($query);
        $req->execute();
        $reqcheck = $req->rowCount();
        if ($reqcheck > 0) {
            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $entreprise = new Entreprise();
                $entreprise->setId($row['id_entreprise']);
                $entreprise->setNomEntreprise($row['nom_entreprise']);
                $entreprise->setAdresseEntreprise($row['ville_entreprise']);
                $entreprises[] = $entreprise;
            }
            return $entreprises;
        } else {
            return false;
        }
        $req->closeCursor();
        $bdd = null;
    }
    /**
     * récupère les infos de toute la bdd d un student
     *
     * @param [type] $id
     * @return void
     */
    public function getInfoStudent($id)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("select * from etudiants join sujet_stage on etudiants.id_etudiant=sujet_stage.num_stagiaire join adresse_entreprise on sujet_stage.num_entreprise=adresse_entreprise.id_entreprise where etudiants.id_etudiant=? ");
        $req->execute(array($id));
        $reqexist = $req->rowCount();
        $j = 0; //pour la taille du tableau
        if ($reqexist > 0) {
            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $etudiant = new Etudiant();
                $entreprise = new Entreprise();
                $sujet = new Sujet();
                $etudiant->setNom($row['nom_etudiant']);
                $etudiant->setPrenom($row['prenom_etudiant']);
                $etudiant->setMail($row['email']);
                $sujet->setDescriptif($row['descriptif']);
                $sujet->setSuperviseur($row['nom_superviseur']);
                $entreprise->setNomEntreprise($row['nom_entreprise']);
                $entreprise->setAdresseEntreprise($row['ville_entreprise']);
                $etudiants[] = $etudiant;
                $sujets[] = $sujet;
                $entreprises[] = $entreprise;
                $j++;
            }
            for ($i = 0; $i < $j; $i++) {
                $globalBdd[$i] = [$etudiants[$i], $sujets[$i], $entreprises[$i]];
            }
            return $globalBdd;
        } else {
            return false;
        }
        $req->closeCursor();
        $bdd = null;
    }
    /**
     * création de l'entreprise dans la bdd
     *
     * @param [type] $nom
     * @param [type] $ville
     * @return void
     */
    public function createEntrepriseBdd($nom, $ville)
    {
        $bdd = $this->bdd;
        try {
            $req = $bdd->prepare("SELECT * FROM adresse_entreprise WHERE nom_entreprise = ? and ville_entreprise = ?");
            $req->execute(array($nom, $ville));
            $exist = $req->rowCount();
            $req->closeCursor();
            if ($exist == 0) {
                $insertmbr = $bdd->prepare("INSERT INTO adresse_entreprise(nom_entreprise, ville_entreprise) VALUES(?, ?)");
                $insertmbr->execute(array($nom, $ville));
                $insertmbr->closeCursor();
                echo  "<p class='message'>Votre entreprise a bien été créé !</p> ";
                return true;
            } else {
                throw new Exception("L'entreprise existe déjà !");
            }
        } catch (Exception $e) { // S'il y a eu une erreur, alors...
            $error = ($e->getMessage());

            return false;
        }
        $bdd = null;
    }
    /**
     * création de l étudiant dans la bdd
     *
     * @param [type] $mail
     * @param [type] $nom
     * @param [type] $prenom
     * @param [type] $mdp
     * @param [type] $mdp2
     * @return void
     */
    public function createStudentBdd($mail, $nom, $prenom, $mdp, $mdp2)
    {
        $bdd = $this->bdd;
        try {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $req = $bdd->prepare("SELECT * FROM etudiants WHERE email = ?");
                $req->execute(array($mail));
                $exist = $req->rowCount();
                $req->closeCursor();
                if ($exist == 0) {
                    $insertmbr = $bdd->prepare("INSERT INTO etudiants(email, mdp, mdp2, nom_etudiant, prenom_etudiant, stage_ok) VALUES(?, ?, ?, ?, ?, ?)");
                    $insertmbr->execute(array($mail, $mdp, $mdp2, $nom, $prenom, '0'));
                    $insertmbr->closeCursor();
                    echo "<p class='message'>Votre compte a bien été créé.</p>";
                    return true;
                } else {
                    throw new Exception('Ce mail est déjà existant');
                }
            } else {
                throw new Exception('Ce mail est invalide');
            }
        } catch (Exception $e) { // S'il y a eu une erreur, alors...
            $error = ($e->getMessage());

            return false;
        }
        $bdd = null;
    }
    /**
     * vérifie si le login de connection est bon
     *
     * @param [type] $username
     * @param [type] $password
     * @return void
     */
    public function validateLogin($username, $password)
    {
        $bdd = $this->bdd;
        $query = "select * from etudiants where email=:username and mdp=:password";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam('username', $username, PDO::PARAM_STR);
        $stmt->bindValue('password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count == 1 && !empty($row)) {
            $_SESSION['userfirstname'] = $row['prenom_etudiant'];
            $_SESSION['username'] = $row['nom_etudiant'];
            $_SESSION['iddbuser'] = $row['id_etudiant'];
            $_SESSION['stage'] = $row['stage_ok'];
            return true;
        } else {
            return false;
        }
        $stmt->closeCursor();
        $bdd = null;
    }
    /**
     * insert le choix de l entreprise
     *
     * @param [type] $descriptif
     * @param [type] $superviseur
     * @param [type] $iduser
     * @param [type] $choix
     * @return void
     */
    public function addChoixEntreprise($descriptif, $superviseur, $iduser, $choix)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM etudiants join sujet_stage on etudiants.id_etudiant=sujet_stage.num_stagiaire join adresse_entreprise on sujet_stage.num_entreprise=adresse_entreprise.id_entreprise where etudiants.id_etudiant=? and adresse_entreprise.id_entreprise=?");
        $req->execute(array($iduser, $choix));
        $reqexist = $req->rowCount();
        try {
            if ($reqexist == 0) {
                $req = $bdd->prepare("INSERT INTO sujet_stage (descriptif, nom_superviseur, num_stagiaire, num_entreprise)VALUES(?,?,?,?)");
                $req->execute(array($descriptif, $superviseur, $iduser, $choix));
                echo "<p class='message'>Vous etes bien inscrit à ce stage.</p>";
                $req->closeCursor();
                $req->closeCursor();
                $_SESSION['stage'] = 1;
                return true;
            } else {
                throw new Exception("Impossible d'encoder. Vous êtes déjà inscris pour ce stage !");
            }
        } catch (Exception $e) { // S'il y a eu une erreur, alors...
            return false;
        }
        $req->closeCursor();
        $bdd = null;
    }
    /**
     * detruit la session au logout
     *
     * @return void
     */
    public function logout()
    {
        $_SESSION['iduser'] = "";
        $_SESSION['password'] = "";
        session_destroy();
        header("location: login");
    }
    /**
     * fonction qui remplace les accentuations
     *
     * @param  $string
     * @return 
     */
    function strToNoAccent($string)
    {
        $string = str_replace(
            array(
                'à', 'â', 'ä', 'á', 'ã', 'å',
                'î', 'ï', 'ì', 'í',
                'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
                'ù', 'û', 'ü', 'ú',
                'é', 'è', 'ê', 'ë',
                'ç', 'ÿ', 'ñ',
                'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
                'Î', 'Ï', 'Ì', 'Í',
                'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø',
                'Ù', 'Û', 'Ü', 'Ú',
                'É', 'È', 'Ê', 'Ë',
                'Ç', 'Ÿ', 'Ñ',
            ),
            array(
                'a', 'a', 'a', 'a', 'a', 'a',
                'i', 'i', 'i', 'i',
                'o', 'o', 'o', 'o', 'o', 'o',
                'u', 'u', 'u', 'u',
                'e', 'e', 'e', 'e',
                'c', 'y', 'n',
                'A', 'A', 'A', 'A', 'A', 'A',
                'I', 'I', 'I', 'I',
                'O', 'O', 'O', 'O', 'O', 'O',
                'U', 'U', 'U', 'U',
                'E', 'E', 'E', 'E',
                'C', 'Y', 'N',
            ),
            $string
        );
        return $string;
    }
}