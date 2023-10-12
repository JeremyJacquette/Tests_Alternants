 ##todo 1 : # Define the API endpoint

#this explains how the script must be run (bash).
 #!/bin/bash
# Define the API endpoint
API_URL='https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records?select=adresse,region,sp95_prix,sp98_prix,gazole_prix,ville&limit=100'

#using curl commands to get the data from the API in silent mode (-s) the silent mode is used here because i don't want to display the progress meter or error messages.
JSON_DATA=$(curl -s "$API_URL")

##todo2 : check if the curl command is successful
# Conditional for verify if the curl is not empty and if it's not empty we can continue the script. 
if [ -n "$JSON_DATA" ]; then
    echo "success"
else
    echo " failed"
    exit 1
fi



