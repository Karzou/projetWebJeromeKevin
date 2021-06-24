<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
    <script type="text/javascript" src="../assets/js/util.js"></script>
</head>

<body>
    <noscript>
        <div id="message_avertissement_javascript" class="message_avertissement_javascript">
            Attention, vous avez désactivé Javascript sur votre navigateur, le site risque de ne pas bien fonctionner
        </div>
    </noscript>
    <div class="content">

        <form id="loginForm" class="formulaire" action="<?php echo connection; ?>" method="post"
            onsubmit="return validateLoginForm()">
            <h1>Stage étudiants - Connexion</h1>
            <hr />
            <div class="row">
                <label class="lab" for="user_name">Adresse E-mail :</label>
                <input class="inp" type="text" id="user_name" name="user_name">
                <span class="error" id="erroremail_login"></span></p>
            </div>
            <div class="row">
                <label class="lab" for="password">Mot de passe :</label>
                <input class="inp" type="password" id="password_login" name="password">
                <span class="error" id="errorpassword_login"></span></p>
            </div>
            <div class="container_button row">
                <div>
                    <input class="bout" name="Connection" type="submit" value="CONNEXION">
                </div>
                <div>
                    <input type="button" class="bout" value="CREATION D'UN COMPTE" name="inscrire"
                        onclick="affiche();" />
                </div>
            </div>
        </form>
        <div class="content2">
            <form id="formedit" class="formulaire" action="<?php echo insertStudent; ?>" name="RegForm"
                style="display:none;" onsubmit="return validationForm()" method="post">
                <h1>Création d'un compte</h1>
                <hr />
                <div class="row">
                    <label class="lab" for="E-mail">Adresse E-mail :</label>
                    <input class="inp" type="E-mail" id="e-mail" name="email"></br>
                    <span class="error" id="erroremail"></span></p>
                </div>
                <div class="pw">
                    <div class="row">
                        <label class="lab" for="password">Mot de passe :</label>
                        <input class="inp" type="password" id="password" value="" name="password1" require
                            minlength="4"></br>
                        <span class="error" id="errorpassword"></span></p>
                    </div>
                    <div class="row">
                        <label class="lab" for="password">Vérification du mot de passe :</label>
                        <input class="inp" type="password" id="password2" value="" name="password2" require
                            minlength="4"></br>
                        <span class="error" id="errorpassword2"></span></p>
                    </div>
                    <div class="row">
                        <label class="lab" for="user_name">Nom :</label>
                        <input class="inp" type="text" id="lastname" name="lastname"></br>
                        <span class="error" id="errorname"></span></p>
                    </div>
                    <div class="row">
                        <label class="lab" for="user_firstname">Prénom :</label>
                        <input class="inp" type="text" id="firstname" name="user_firstname"></br>
                        <span class="error" id="errorfirstname"></span></p>
                    </div>
                    <div class="container_button row">
                        <div>
                            <input class="bout" name="sauvegarder" type="submit" value="SAUVEGARDER"></input>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
</body>
<footer id="footer">
    <div class="copyright">
        <p>Copyright 2021, Editor Vanconingsloo Kevin & Deschamps Jérôme</p>
    </div>
</footer>

</html>