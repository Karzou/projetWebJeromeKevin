<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="assets/css/stylesheet.css">

    <script type="text/javascript" src="assets/js\util.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>

<body>
    <noscript>
        <div id="message_avertissement_javascript" class="message_avertissement_javascript">
            <p>
                Attention, Javascript est désactivé sur votre navigateur, le site risque de ne pas fonctionner
                correctement !!!
            </p>
        </div>
    </noscript>
    <div class="menu">
        <ul>
            <?php echo "<h1 class='nom'>" . $_SESSION['userfirstname'] . "</h1>"; ?>
            <li><a class="bout" href="<?php echo home; ?>">Acceuil</a></li>
            <li><a class="bout" href="<?php echo listeEtudiants; ?>">Liste des étudiants</a></li>
            <?php
            if ($_SESSION['stage'] > 0) {
            ?>
            <li><a class="bout" href="<?php echo infoStage; ?>">Information sur mes stages</a></li>
            <?php
            }
            ?>
            <li><a class="bout" href="<?php echo encoderEntreprise; ?>">Encoder un lieu de stage</a></li>
            <?php
            if ($_SESSION['entreprise'] > 0) {
            ?>
            <li><a class="bout" href="<?php echo listeEntreprises; ?>">Liste des adresses d'entreprises</a></li>
            <?php
            }
            ?>
            <li><a class="bout" href="<?php echo logout; ?>">Se déconnecter</a></li>
        </ul>
    </div>
    <!-- ma page -->
    <?php
    echo $contentPage;
    ?>
</body>
<footer>
    <div class="copyright">
        <p>Copyright 2021, Editor Vanconingsloo Kevin & Deschamps Jérôme</p>
    </div>
</footer>

</html>