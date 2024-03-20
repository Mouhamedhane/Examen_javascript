<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transformation de chaînes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        pre {
            white-space: pre-wrap;
        }
    </style>
</head>

<body>

    <section>
        <?php
        function transformerChaine(&$tableau)
        {
            foreach ($tableau as &$chaine) {
                $chaine = ucfirst(strtolower($chaine));
            }
        }

        $chaines = ["ExEMplE", "MiXte", "maJuscules"];
        echo "Tableau avant transformation :<br><pre>" . print_r($chaines, true) . "</pre>";

        transformerChaine($chaines);

        echo "Tableau après transformation :<br><pre>" . print_r($chaines, true) . "</pre>";
        ?>
    </section>

</body>

</html>
