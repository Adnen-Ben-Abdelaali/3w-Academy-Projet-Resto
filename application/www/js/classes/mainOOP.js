
"use strict";


$(function () {
  // Effet spécial sur la boite de notifications (le flash bag).
  $('#notice').delay(3000).fadeOut('slow');

  // Exécution de la validation de formulaire si besoin.

  if (typeof FormValidator != "undefined") {


    let formValidator = new FormValidator();

    formValidator.runFormValidation();


  } else {
    console.log("gg");
  }




}); 