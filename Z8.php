<?php
$samochody = [
    [
        'marka' => 'BMW',
        'model' => '320d',
        'rok' => 2018,
        'cena' => 85000,
        'przebieg' => 120000,
        'paliwo' => 'diesel',
        'moc' => 190
    ],
    [
        'marka' => 'Audi',
        'model' => 'A4',
        'rok' => 2020,
        'cena' => 110000,
        'przebieg' => 80000,
        'paliwo' => 'benzyna',
        'moc' => 150
    ],
    [
        'marka' => 'Volkswagen',
        'model' => 'Golf VII',
        'rok' => 2016,
        'cena' => 55000,
        'przebieg' => 160000,
        'paliwo' => 'diesel',
        'moc' => 150
    ],
    [
        'marka' => 'Toyota',
        'model' => 'Corolla',
        'rok' => 2023,
        'cena' => 95000,
        'przebieg' => 30000,
        'paliwo' => 'benzyna',
        'moc' => 122
    ],
    [
        'marka' => 'Skoda',
        'model' => 'Octavia',
        'rok' => 2019,
        'cena' => 78000,
        'przebieg' => 110000,
        'paliwo' => 'diesel',
        'moc' => 150
    ],
    [
        'marka' => 'Ford',
        'model' => 'Focus',
        'rok' => 2015,
        'cena' => 42000,
        'przebieg' => 190000,
        'paliwo' => 'benzyna',
        'moc' => 125
    ],
    [
        'marka' => 'Opel',
        'model' => 'Astra K',
        'rok' => 2017,
        'cena' => 52000,
        'przebieg' => 145000,
        'paliwo' => 'diesel',
        'moc' => 136
    ],
    [
        'marka' => 'Kia',
        'model' => 'Ceed',
        'rok' => 2022,
        'cena' => 89000,
        'przebieg' => 45000,
        'paliwo' => 'benzyna',
        'moc' => 140
    ],
    [
        'marka' => 'Hyundai',
        'model' => 'i30',
        'rok' => 2014,
        'cena' => 38000,
        'przebieg' => 210000,
        'paliwo' => 'benzyna',
        'moc' => 100
    ],
    [
        'marka' => 'Mercedes',
        'model' => 'C 200',
        'rok' => 2021,
        'cena' => 145000,
        'przebieg' => 60000,
        'paliwo' => 'benzyna',
        'moc' => 204
    ]
];

usort($samochody, function($a, $b) {
    return $a['cena'] <=> $b['cena'];
});

function obliczWiek($rokProdukcji) {
    $aktualnyRok = 2026;
    return $aktualnyRok - $rokProdukcji;
}

function kategoriaWieku($wiek) {
    if ($wiek <= 3) {
        return "samochód prawie nowy";
    } elseif ($wiek >= 4 && $wiek <= 7) {
        return "samochód kilkuletni";
    } elseif ($wiek >= 8 && $wiek <= 15) {
        return "samochód używany";
    } else {
        return "samochód zabytkowy lub starszy";
    }
}

function wyszukajSamochody($samochody, $maksymalnaCena) {
    echo "<h3>Wyszukiwanie samochodów (cena do " . number_format($maksymalnaCena, 0, '', ' ') . " zł):</h3>";
    $znaleziono = false;
    foreach ($samochody as $s) {
        if ($s['cena'] <= $maksymalnaCena) {
            echo "- {$s['marka']} {$s['model']} ({$s['cena']} zł)<br>";
            $znaleziono = true;
        }
    }
    if (!$znaleziono) {
        echo "Nie znaleziono żadnego samochodu w tej cenie.<br>";
    }
    echo "<br>";
}

function najdrozszySamochod($samochody) {
    if (empty($samochody)) return null;
    $najdrozszy = $samochody[0];
    foreach ($samochody as $s) {
        if ($s['cena'] > $najdrozszy['cena']) {
            $najdrozszy = $s;
        }
    }
    return $najdrozszy;
}

function najtanszySamochod($samochody) {
    if (empty($samochody)) return null;
    $najtanszy = $samochody[0];
    foreach ($samochody as $s) {
        if ($s['cena'] < $najtanszy['cena']) {
            $najtanszy = $s;
        }
    }
    return $najtanszy;
}

function obliczSredniaCene($samochody) {
    if (empty($samochody)) return 0;
    $suma = 0;
    foreach ($samochody as $s) {
        $suma += $s['cena'];
    }
    return $suma / count($samochody);
}

echo "<pre>";
echo "================================\n";
echo "        KOMIS SAMOCHODOWY       \n";
echo "================================\n\n";

foreach ($samochody as $s) {
    $wiek = obliczWiek($s['rok']);
    $kategoria = kategoriaWieku($wiek);
    
    echo "{$s['marka']} {$s['model']}\n";
    echo "Rok produkcji: {$s['rok']}\n";
    echo "Cena: " . number_format($s['cena'], 0, '', ' ') . " zł\n";
    echo "Przebieg: " . number_format($s['przebieg'], 0, '', ' ') . " km\n";
    echo "Paliwo: {$s['paliwo']}\n";
    echo "Moc: {$s['moc']} KM\n";
    echo "Wiek: {$wiek} lat\n";
    echo "Kategoria: {$kategoria}\n";
    echo "\n--------------------------------\n\n";
}

wyszukajSamochody($samochody, 70000);

$liczbaSamochodow = count($samochody);
$sredniaCena = obliczSredniaCene($samochody);
$autoNajdrozsze = najdrozszySamochod($samochody);
$autoNajtanszy = najtanszySamochod($samochody);

$liczbaDiesli = 0;
$liczbaPo2020 = 0;
$liczbaNiskiPrzebieg = 0;

foreach ($samochody as $s) {
    if (strtolower($s['paliwo']) == 'diesel') {
        $liczbaDiesli++;
    }
    if ($s['rok'] > 2020) {
        $liczbaPo2020++;
    }
    if ($s['przebieg'] < 100000) {
        $liczbaNiskiPrzebieg++;
    }
}

echo "================================\n";
echo "           STATYSTYKI           \n";
echo "================================\n";
echo "Liczba samochodów: {$liczbaSamochodow}\n";
echo "Średnia cena: " . number_format($sredniaCena, 0, '', ' ') . " zł\n";
echo "Najdroższy: {$autoNajdrozsze['marka']} {$autoNajdrozsze['model']}\n";
echo "Najtańszy: {$autoNajtanszy['marka']} {$autoNajtanszy['model']}\n";
echo "Samochody diesel: {$liczbaDiesli}\n";
echo "Samochody po 2020 roku: {$liczbaPo2020}\n";
echo "Przebieg poniżej 100 000 km: {$liczbaNiskiPrzebieg}\n";
echo "================================\n";
echo "</pre>";
?>