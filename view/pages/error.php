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
    <div class="erreur">
        <h1>Un problème est survenu <?php /*echo $_SESSION['userfirstname']  . " " . $_SESSION['username']; */ ?>!</h1>
        <h1> <?php echo $erreur; ?> </h1>
        <a class="bout" id="errorBout" href="<?php echo $page; ?>">Retour</a>

    </div>

    </div>
</body>
<footer>
    <div class="copyright">
        <p>Copyright 2021, Editor Vanconingsloo Kevin & Deschamps Jérôme</p>
    </div>
</footer>

</html>