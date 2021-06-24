<div class="content">

    <h1 class="titre_liste">Liste des entreprises</h1>
    <div class="contentTab">
        <form class="tab" method="POST" action="<?php echo choixEntreprise; ?>" onsubmit="return validateSuperviseur()">
            <table id="myTable2" class="table">
                <thead>
                    <tr>
                        <th>Entreprise</th>
                        <th>Ville</th>
                        <th>Choix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //$i = 0;
                    foreach ($params as $entreprise) : ?>

                    <tr>
                        <td><?php echo $entreprise->getNomEntreprise(); ?></td>
                        <td><?php echo $entreprise->getAdresseEntreprise(); ?></td>
                        <td><input onclick="insertRow(this, <?php echo $entreprise->getId(); ?>);" class="bout"
                                type="button" name="sauvegarder" value="s'inscrire"></td>
                    </tr>
                    </td>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="button" id="tri1" class="bout" value="Trier par entreprise" onclick="sortTable(0)"></input>
            <input type="button" id="tri2" class="bout" value="Trier par ville" onclick="sortTable(1)"></input>
        </form>

        <?php
        if (isset($erreur)) {
            echo '<font color="red">' . $erreur . "</font>";
        }
        ?>
    </div>
</div>