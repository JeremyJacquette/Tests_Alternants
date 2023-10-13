<?php
//!TODO 1:  Define the API endpoint
//Define the API endpoint as a constant
$API_URL = 'https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records?select=adresse,region,sp95_prix,sp98_prix,gazole_prix,ville&limit=100';

//!TODO 2: Get the data from the API
//Use file_get_contents() to get the data from the API
$response = file_get_contents($API_URL);

//!TODO 3:  foreach result, sort by region 
//!TODO 4:  Sort the regions by the lowest price of SP98   
//!TODO 5:  Sort the regions by the lowest price of SP95
//!TODO 6:  Sort the regions by the lowest price of Gazole
//!TODO 7:  Display the sorted results  