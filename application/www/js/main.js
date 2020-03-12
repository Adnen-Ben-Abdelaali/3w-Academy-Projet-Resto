'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// VARAIABLES                                                                          //
/////////////////////////////////////////////////////////////////////////////////////////

let form = $('form[data-validation]');
let errorMessage = form.find('.error-message');
let totalErrorCount = form.find('#total-error-count');

// Tableau général de toutes les erreurs de validation trouvées.
let totalErrors;

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

function checkDataTypes() {

  let tableauErreursType = new Array();

  form.find('[data-type]').each(function () {

    if (($(this).data('type') === 'positiveInteger') && !isInteger($(this).val().trim()) && ($(this).val().trim() <= 0)) {

      tableauErreursType.push(
        {
          fieldName: $(this).data("name"),
          errorMessage: "le nombre n'est pas un entier : "
        }
      );

    } else if (($(this).data('type') === 'positiveNumber') && !isNumber($(this).val().trim()) && ($(this).val().trim() <= 0)) {

      tableauErreursType.push(
        {
          fieldName: $(this).data("name"),
          errorMessage: "le nombre n'est pas un prix valide : "
        }
      );
    }
  });

  $.merge(totalErrors, tableauErreursType);
}

function checkMinimumLength() {
  let tableauErreurs = new Array();

  form.find('[data-length]').each(function () {
    let valueOfSelectedElement = $(this).val().trim();

    if (valueOfSelectedElement.length < $(this).data("length")) {

      tableauErreurs.push(
        {
          fieldName: $(this).data("name"),
          errorMessage: "le nombre minimal de caractères est : " + $(this).data("length")
        }
      );
    }
  });

  $.merge(totalErrors, tableauErreurs);
}

function checkRequiredFields() {
  // Création d'un tableau contenant les erreurs trouvées.
  let errors = [];

  // Boucle de recherche de tous les champs de formulaires requis.
  form.find('[data-required]').each(function () {
    /*
     * La méthode jQuery each() change la valeur de la variable this :
     * elle représente tous les objets DOM sélectionnés.
     *
     * Pour notre cas elle représente donc tour à tour chaque champ de
     * formulaire trouvé avec la méthode jQuery find().
     */

    // Récupération de la valeur du champ du formulaire (sans les espaces).
    let value = $(this).val().trim();

    // Est-ce que quelque chose a été saisi ?
    if (value.length == 0) {
      // Non, alors que le champ est requis, donc il y a une erreur.
      errors.push(
        {
          fieldName: $(this).data('name'),
          message: 'est requis'
        });
    }
  });

  // Copie des erreurs trouvées dans le tableau général des erreurs.
  $.merge(totalErrors, errors);
}

function onSubmitForm(event) {
  // Recherche de la balise HTML <p> contenant tous les messages d'erreurs.
  let errorList = errorMessage.children('p');
  errorList.empty();

  // Exécution des différentes validations.
  totalErrors = [];
  checkRequiredFields();
  checkDataTypes();
  checkMinimumLength();

  // Est-ce que des erreurs ont-été trouvées?
  if (totalErrors.length > 0) {
    event.preventDefault();

    // Boucle d'affichage de toutes les erreurs trouvées.
    totalErrors.forEach(function (error) {
      // Construction du message d'erreur final.
      let message =
        '<p>' + 'Le champ <em><strong>' + error.fieldName +
        '</strong></em> ' + error.message + '</p>';

      // Ajout du message d'erreur final à la fin de la balise HTML <p>.
      errorList.append(message);
    });

    // Mise à jour du compteur du nombre total d'erreurs trouvées.
    totalErrorCount.text(totalErrors.length);

    // Affichage de la boite de messages.
    errorMessage.fadeIn('slow');
  }
}

function run() {
  // Installation d'un gestionnaire d'évènement sur la soumission du formulaire.
  form.on('submit', onSubmitForm);

  // Est-ce qu'il y a déjà des messages d'erreurs dans la boite de messages ?
  if (errorMessage.children('p').text().length > 0) {
    // Oui, affichage de la boite de messages.
    errorMessage.fadeIn('slow');
  }
}

function runFormValidation() {
  // Y a t'il un formulaire à valider sur la page actuelle ?
  if (form.length == 1) {
    // Oui, exécution de la validation de formulaire.
    run();
  }
}

/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function () {
  // Effet spécial sur la boite de notifications (le flash bag).
  $('#notice').delay(3000).fadeOut('slow');

  // Exécution de la validation de formulaire si besoin.
  runFormValidation();
}); 
