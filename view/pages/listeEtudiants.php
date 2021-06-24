    <div class="">
        <h1 class="titre">Liste des étudiants</h1>
        <form method="POST" action="<?php echo infoStage; ?>">
            <table class="table_form" id="table">
                <thead>
                    <tr>
                        <th>
                        <th>Noms</th>
                        <th>Prénoms</th>
                        <th>Email</th>
                        <th>Stages de l'étudiant</th>
                        <th id="cacher">Nombre de stage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($params as $etudiant) : ?>

                    <tr id="visible" class="visible">
                        <td class="cell"><?php echo $etudiant->getId(); ?></td>
                        <td class="cell"><?php echo $etudiant->getNom(); ?></td>
                        <td class="cell"><?php echo $etudiant->getPrenom(); ?></td>
                        <td class="cell"><?php echo $etudiant->getMail(); ?></td>
                        <td class="cell">
                            <?php

                                $condition = $etudiant->getNbrStage(); // ou etudiant->getStage == 1

                                if ($condition > 0) {
                                    echo '<button class="bout"type="submit"id="choix"name="choix"value="' . $etudiant->getId() . '">info stage</button>';
                                }
                                ?></td>
                        <td id="cacher" class="cell"><?php echo $condition ?></td>

                    </tr>
                    <?php endforeach;

                    ?>
                </tbody>
            </table>
            <input class="bouton_check" type="checkbox" onclick="cacherTableau()">afficher sans stage</input>
        </form>
    </div>