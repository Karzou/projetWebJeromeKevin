<div class="content">

    <h1 class="titre_accueil">Encoder un nouveau lieu de stage</h1>

    <form id="formEntreprise" class="formulaire" name="formEntreprise" action="<?php echo insertEntreprise; ?>"
        onsubmit="return validateEntreprise()" method="post">

        <div class="row">
            <label class="lab" for="user_name">Nom de l'entreprise :</label>
            <input class="inp" type="text" id="nameEntreprise" name="user_name"></br>
            <span class="error" id="errorentreprise"></span></p>
        </div>

        <div class="row">
            <label class="lab" for="password">Ville de l'entreprise :</label>
            <select class="inp" type="text" id="ville" name="ville">
                <option></option>
                <script>
                var myArray = new Array("Arlon ", "Bruxelles", "Charleroi", "Gembloux", "Hornu", "Liege",
                    "Namur", "Nivelles", "Mons");
                for (i = 0; i < myArray.length; i++) {
                    document.write('<option value="' + myArray[i] + '">' + myArray[i] + '</option>');
                }
                </script>
            </select></br>
            <span class="error" id="errorville"></span></p>
        </div>

        <div class="container_button row">
            <div>
                <input class="bout" name="sauvegarder" type="submit" value="Sauvegarder">
            </div>
        </div>
    </form>
</div>