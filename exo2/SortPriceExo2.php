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
    $sp95 = $result['sp95_prix'];
    $sp98 = $result['sp98_prix'];
    $gazole = $result['gazole_prix'];
    //if the region is not set in the sortedResults array, set it
    if (!isset($sortedResults[$region])) {
        $sortedResults[$region] = [
            'ville' => $city,
            'adresse' => $address,
            'SP95' => $sp95,
            'SP98' => $sp98,
            'Gazole' => $gazole,
        ];
    }
    $sortedResults[$region]['SP95'] = isset($result['sp95_prix']);
    $sortedResults[$region]['SP98'] = isset($result['sp98_prix']);
    $sortedResults[$region]['Gazole'] = isset($result['gazole_prix']);
}


//!TODO 4:  Sort the regions by the lowest price of SP98   
//!TODO 5:  Sort the regions by the lowest price of SP95
//!TODO 6:  Sort the regions by the lowest price of Gazole
//!TODO 7:  Display the sorted results  