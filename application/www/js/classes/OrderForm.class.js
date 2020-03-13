"use strict";

class orderForm {
  constructor() {
    this.form = $('form[data-validation]');
    this.meal = this.form.find("#meal");
    this.mealDetails = this.form.find("#meal-details");
    this.orderSummary = this.form.find("#order-summary");
    this.validateOrder = this.form.find("#validate-order");

    this.basketSession = new BasketSession();
  }

  onChangeMeal() {

    return $(this).val();

  }



}