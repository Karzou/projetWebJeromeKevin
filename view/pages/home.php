<div class="content">
    <h1 class="titre_accueil">Bienvenue <?php echo $_SESSION['username']  . " " . $_SESSION['userfirstname']; ?>!</h1>

    <table class="accueil_table">
        <tr>
            <th class="accueil">Nombre d'étudiants</th>
            <th class="accueil">Nombre d'entreprises</th>
            <th class="accueil">Nombre de vos stages</th>

        </tr>
        <tr>
            <td class="accueil"><?php echo $params[0]; ?></td>
            <td class="accueil"><?php echo $params[1]; ?></td>
            <td class="accueil"><?php echo $params[2]; ?></td>
        </tr>
    </table>
    <div class="meteo">
        <!-- widget meteo -->
        <div id="widget_0c3d43eafe98072d6ef6b1ae1faa6af2">
            <span id="t_0c3d43eafe98072d6ef6b1ae1faa6af2">Météo Charleroi</span>
            <span id="l_0c3d43eafe98072d6ef6b1ae1faa6af2"><a
                    href="http://www.mymeteo.info/r/accueil_jx">My-Meteo</a></span>
            <script type="text/javascript">
            (function() {
                var my = document.createElement("script");
                my.type = "text/javascript";
                my.async = true;
                my.src =
                    "https://services.my-meteo.com/widget/js?ville=649&format=petit-horizontal&nb_jours=3&icones&vent&c1=393939&c2=a9a9a9&c3=e6e6e6&c4=ffffff&c5=00d2ff&c6=d21515&police=0&t_icones=1&x=421.5999755859375&y=56&d=0&id=0c3d43eafe98072d6ef6b1ae1faa6af2";
                var z = document.getElementsByTagName("script")[0];
                z.parentNode.insertBefore(my, z);
            })();
            </script>
        </div>
        <!-- widget meteo -->
    </div>
</div>