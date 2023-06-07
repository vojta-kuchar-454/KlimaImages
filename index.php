<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Galerie obrázků</title>
    <style>
        .image-gallery {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .image-gallery img {
            max-width: 80%;
            max-height: 80%;
        }
    </style>
</head>
<body>
<div class="image-gallery">
    <?php


    // Získání seznamu souborů v dané složce
    //Načte všechny soubory co jsou ve složce pictures v tomto adresáři, musí být v tomto adresáři! Tedy ve stejném adresáři kde je php script.
    $obrazky = glob(dirname(realpath(__FILE__)).'\\pictures\\' . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    // Získání aktuálního indexu obrázku z URL parametru
    $aktualniIndex = isset($_GET['index']) ? intval($_GET['index']) : 0;
    $pocetObrazku = count($obrazky);

    // Určení indexů předchozího a následujícího obrázku
    if ($aktualniIndex > 0) {
        $predchoziIndex = $aktualniIndex - 1;
    } else {
        $predchoziIndex = $pocetObrazku - 1;
    }

    $nasledujiciIndex = ($aktualniIndex < $pocetObrazku - 1) ? $aktualniIndex + 1 : 0;

    // Odstranění všeho před slovem "pictures" v cestě, nutné pro načtení, jinak problém s "lokální cestou" prohlížeč to zablokuje
    $novySoubor = substr($obrazky[$aktualniIndex], strpos($obrazky[$aktualniIndex], 'pictures'));
    // Zobrazení aktuálního obrázku
    echo '<img src="' . htmlspecialchars($novySoubor) . '" alt="Obrázek"><br>';

    // Odkazy na předchozí a následující obrázek
    echo '<a href="?index=' . $predchoziIndex . '">&#8592; Next</a>';
    echo ' | ';
    echo '<a href="?index=' . $nasledujiciIndex . '">Previous &#8594;</a>';

    ?>

</div>
</body>
</html>