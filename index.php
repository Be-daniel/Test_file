<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <style>
        .Form-test {
            margin: 10px auto;
            padding: 100px 450px;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            border-radius: 10px;
        }

        table,
        th,
        td {
            border: 2px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="Form-test">


        <h1>Test File</h1>
        <form method="post">
            <label for="path">Saisir le chemin :</label>
            <input type="text" id="path" name="path" required>
            <button type="submit">Valider</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $path = $_POST['path'];
            compteur_Files_Lines($path);
        }

        function compteur_Files_Lines($path)
        {

            if (!is_dir($path)) {
                echo "<p>Le chemin spécifié n'est pas un répertoire valide.</p>";
                return;
            }
            $fichiers = scandir($path);
            $nombreFichiers = 0;
            $lignesParFichier = [];

            foreach ($fichiers as $fichier) {

                if ($fichier === '.' || $fichier === '..' || strpos($fichier, '~$') === 0) {
                    continue;
                }
                $cheminFichier = $path . DIRECTORY_SEPARATOR . $fichier;

                if (is_file($cheminFichier)) {
                    $nombreFichiers++;
                    $lignes = file($cheminFichier);
                    $nombreLignes = count($lignes);
                    $extension = pathinfo($fichier, PATHINFO_EXTENSION);
                    $lignesParFichier[] = [
                        'nom' => $fichier,
                        'extension' => $extension,
                        'lignes' => $nombreLignes
                    ];
                }
            }
            
            // usort($lignesParFichier, function ($a, $b) {
            //     return strcmp($a['nom'], $b['nom']);
            // });

            echo "<h2>Résultats :</h2>";
            echo "<p>Nombre total de fichiers : $nombreFichiers</p>";
            echo "<table>";
            echo "<tr><th>Nom du Fichier</th><th>Extension</th><th>Nombre de Lignes</th></tr>";
            foreach ($lignesParFichier as $fichierInfo) {
                echo "<tr>
                    <td>{$fichierInfo['nom']}</td>
                    <td>{$fichierInfo['extension']}</td>
                    <td>{$fichierInfo['lignes']}</td>
                  </tr>";
            }
            echo "</table>";
        }
        ?>

    </div>
</body>

</html>