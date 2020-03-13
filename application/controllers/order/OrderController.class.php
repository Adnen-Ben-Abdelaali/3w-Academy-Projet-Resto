<?php

  class OrderController
  {
    public function httpGetMethod(Http $http, array $queryFields)

      // $queryFields : équivalent au tableau $_GET

    {   
      $mealList = new MealModel();

      var_dump($mealList->getAllMeal());

      return  [ "meals" => $mealList->getAllMeal() ];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      // $formFields : équivalent au tableau $_POST

        return [];
    }
  
}


