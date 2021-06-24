<div class="content">

    <h1 class="titre">Information de stage</h1>

    <table class="table" id="myTable2">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Entreprise de stage</th>
                <th>Adresse de stage</th>
                <th>Description</th>
                <th>Nom du superviseur</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($params as $rows) :
                $etudiant = $rows[0];
                $sujet = $rows[1];
                $entreprise = $rows[2];
            ?>
            <tr>
                <td><?php echo $etudiant->getNom(); ?></td>
                <td><?php echo $etudiant->getPrenom(); ?></td>
                <td><?php echo $etudiant->getMail(); ?></td>
                <td><?php echo $entreprise->getNomEntreprise(); ?></td>
                <td><?php echo $entreprise->getAdresseEntreprise(); ?></td>
                <td><?php echo $sujet->getDescriptif(); ?></td>
                <td><?php echo $sujet->getSuperviseur(); ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    </br>
    <a class="bout" id="bouton_retour" href="<?php echo listeEtudiants; ?>">Retour liste des étudiants</a>
</div>