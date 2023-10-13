<?php

//!TODO 1:  Define the API endpoint
//Define the API endpoint as a constant
$API_URL = 'https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records?select=adresse,region,sp95_prix,sp98_prix,gazole_prix,ville&limit=100';

//!TODO 2: Get the data from the API
//Use file_get_contents() to get the data from the API
$response = file_get_contents($API_URL);

//decode the JSON string into an array of results
$data = json_decode($response, true);
$results = $data["results"];
$sortedResults = [];
//!TODO 3:  foreach result, sort by region 
//loop through the results
foreach ($results as $result) {
    $region = $result['region'];
    $city = $result['ville'];
    $address = $result['adresse'];
   
    //if the region is not set in the sortedResults array, set it
    if (!isset($sortedResults[$region])) {
        $sortedResults[$region] = [
            'ville' => $city,
            'adresse' => $address,
            //set the price to null because we don't know yet(fix the bug)
            'SP95' => NULL,
            'SP98' => NULL,
            'Gazole' => NULL,
        ];
    }
    //if the region is set in the sortedResults array, check if the price is set and if not, set it
    $sortedResults[$region]['SP95'] = isset($result['sp95_prix']) ? floatval($result['sp95_prix']) : null;
    $sortedResults[$region]['SP98'] = isset($result['sp98_prix']) ? floatval($result['sp98_prix']) : null;
    $sortedResults[$region]['Gazole'] = isset($result['gazole_prix']) ? floatval($result['gazole_prix']) : null;
}

//!TODO 4:  Sort the regions by the lowest price of SP95 
//i used uasort() to sort the array by the lowest price of SP95 documentation here :https://www.php.net/manual/fr/function.uasort.php
uasort($sortedResults, function ($a, $b) {
    $aMin95 = $a['SP95'] ?? PHP_FLOAT_MAX;
    $bMin95 = $b['SP95'] ?? PHP_FLOAT_MAX;
    $aMin98 = $a['SP98'] ?? PHP_FLOAT_MAX;
    $bMin98 = $b['SP98'] ?? PHP_FLOAT_MAX;
    $aMinGaz = $a['Gazole'] ?? PHP_FLOAT_MAX;
    $bMinGaz = $b['Gazole'] ?? PHP_FLOAT_MAX;

    if ($aMin95 !== $bMin95) {
        return $aMin95 <=> $bMin95;
    } elseif ($aMin98 !== $bMin98) {
        return $aMin98 <=> $bMin98;
    } else {
        return $aMinGaz <=> $bMinGaz;
    }
});
//!TODO 7:  Display the sorted results  

foreach ($sortedResults as $region => $station) {
    echo "$region :\n";
    if (!is_null($station['SP95'])) {
        echo "  SP95 : " . $station['SP95'] . "€ / {$station['adresse']} {$station['ville']}\n";
    } else {
        echo "  SP95 : Données non disponibles\n";
    }

if (!is_null($station['SP98'])) {
    echo "  SP98 : " . $station['SP98'] . "€ / {$station['adresse']} {$station['ville']}\n";
}    else {
        echo "  SP98 : Données non disponibles\n";
    }

    if (!is_null($station['Gazole'])) {
        echo "  Gazole : " . $station['Gazole'] . "€ / {$station['adresse']} {$station['ville']}\n";
    } else {
        echo "  Gazole : Données non disponibles\n";
    }
}

?>
    
    
    
    
    
    