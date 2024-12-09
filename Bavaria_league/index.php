<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fairplay</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Honk&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
</head>


<body>
    <div class="wrapper">
        <?php require_once("php/Controllers/dataController.php") ?>
        <header>
            <h1>Bavaria league</h1>
        </header>
        <main>
            <div class="introduction">
                <h3>Fair-play website</h3>
                <p>
                    De SPORT-bond ziet toe op een eerlijk verloop van de competitie. Onze topsporters dienen een
                    voorbeeld
                    te zijn voor de vele amateurs in de sport. Daarom streven we naar fair play; een sportieve omgang
                    met
                    elkaar. Daar hoort ook bij dat er weinig overtredingen plaatsvinden tijdens een wedstrijd. Op deze
                    website geven we inzicht in het verloop van de competitie tot nu toe. U ziet de wedstrijden met de
                    minste overtredingen, maar voor bewustwording brengen we ook de wedstrijden met de meeste
                    overtredingen
                    in beeld.
                </p>
            </div>

            <div class="grid">

                <div class="grid-item">
                    <h3>Aantal overtredingen:</h3>
                    <p class="grid-item-number">
                        <?php echo file_get_contents("data/total.txt"); ?>
                    </p>
                </div>
                <div class="grid-item">
                    <h3>Gemiddeld per wedstrijd:</h3>
                    <p class="grid-item-number">
                        <?php echo file_get_contents("data/averageFoul.txt"); ?>
                    </p>
                </div>

                <div class="grid-item-large">
                    <h3>Wedstrijden met meeste overtredingen:</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Team1</th>
                                <th>Team2</th>
                                <th>Uitslag</th>
                                <th>Scheidsrechter</th>
                                <th>Overtredingen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = file_get_contents("data/blackBook.txt");
                            $lines = explode("\n", $data);

                            foreach ($lines as $line) {
                                if (trim($line) == "")
                                    continue;
                                list($date, $home, $away, $score, $ref, $fouls) = explode(", ", $line);

                                echo "<tr>";
                                echo "<td class='table-text-align-center'>" . htmlspecialchars($date) . "</td>";
                                echo "<td class='table-text-align-right'>" . htmlspecialchars($home) . "</td>";
                                echo "<td class='table-text-align-right'>" . htmlspecialchars($away) . "</td>";
                                echo "<td class='table-text-align-center'>" . htmlspecialchars($score) . "</td>";
                                echo "<td class='table-text-align-right'>" . htmlspecialchars($ref) . "</td>";
                                echo "<td class='table-text-align-center'>" . htmlspecialchars($fouls) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="grid-item-large">
                    <h3>Wedstrijden met minder dan 2 overtredingen (laatste 21 dagen):</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Team1</th>
                                <th>Team2</th>
                                <th>Uitslag</th>
                                <th>Scheidsrechter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = file_get_contents("data/hallOfFame.txt");
                            $lines = explode("\n", $data);

                            foreach ($lines as $line) {
                                if (trim($line) == "")
                                    continue;
                                list($date, $home, $away, $score, $ref) = explode(", ", $line);

                                echo "<tr>";
                                echo "<td class='table-text-align-center'>" . htmlspecialchars($date) . "</td>";
                                echo "<td class='table-text-align-right'>" . htmlspecialchars($home) . "</td>";
                                echo "<td class='table-text-align-right'>" . htmlspecialchars($away) . "</td>";
                                echo "<td class='table-text-align-center'>" . htmlspecialchars($score) . "</td>";
                                echo "<td class='table-text-align-right'>" . htmlspecialchars($ref) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </main>

        <footer>
            <p>
                Deze website is gemaakt in het kader van een praktijkopdracht bij de opleiding Software Developer, Curio
                Breda.
            </p>
            <p>
                &copy; Martijn, Jason, 2024
            </p>
        </footer>
    </div>
</body>

</html>