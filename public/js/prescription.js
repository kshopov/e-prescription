
function autocompleteMedicationName(inputId) {
    $( function() {
        $( inputId ).autocomplete({
            source: '/eprescription/searchmedication/?',
            minLength: 2
        });
    } );
}

function autocompleteCountry(inputId) {
    $( function() {
        $( inputId ).autocomplete({
            source: '/eprescription/getCountryCode/?'
        });
    } );
}

function autocompleteCity(inputId) {
    $( function() {
        $( inputId ).autocomplete({
            source: '/eprescription/getCity/?'
        });
    } );
}