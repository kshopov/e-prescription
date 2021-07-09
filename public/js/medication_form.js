function changeMedicationView(medicationId) {
    var elementToHide = '';
    var elementToShow = 'medicationrow' + (++medicationId);
    --medicationId;
    if(medicationId == 3) {
        elementToHide = 'medicationrow' + 3;
        elementToShow = 'medicationrow' + 1;
    } else {
        elementToHide = 'medicationrow' + medicationId;
    }

    document.getElementById(elementToShow).hidden = false;
    document.getElementById(elementToHide).hidden = true;
}