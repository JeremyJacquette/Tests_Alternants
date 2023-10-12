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
    # Extract the results from the JSON data iwth jq command
  RESULTS=$(echo "$JSON_DATA" | jq -c '.results[]')
##todo3 : Display all the data, one by one, with a loop.
# Iterate over the variable results and display the data with IFS command (Internal Field Separator) to split the data into lines. I used this documentation : https://www.malekal.com/bash-ifs-utilisation-exemples/
  while IFS= read -r record; do
  #the jq -r is used for remove the double quotes from the output 
    REGION=$(echo "$record" | jq -r '.region')
    VILLE=$(echo "$record" | jq -r '.ville')
    ADRESSE=$(echo "$record" | jq -r '.adresse')
    SP95_PRIX=$(echo "$record" | jq -r '.sp95_prix // "No data"')
    SP98_PRIX=$(echo "$record" | jq -r '.sp98_prix // "No data"')
    GAZOLE_PRIX=$(echo "$record" | jq -r '.gazole_prix // "No data"')
    
# Display the data into the terminal using echo command
    echo "Region: $REGION"
    echo "  Ville: $VILLE"
    echo "  Adresse: $ADRESSE"
    echo "  SP95 Prix: $SP95_PRIX"
    echo "  SP98 Prix: $SP98_PRIX"
    echo "  Gazole Prix: $GAZOLE_PRIX"
    #echo for add space into the terminal for lisibility (optional)
    echo
# done is used to end the while loop
  done <<< "$RESULTS"
else
# error message if the curl command is not successful
  echo "Failed to retrieve data from the API."
fi

###todo4 : add algorithm to find the cheapest gas station