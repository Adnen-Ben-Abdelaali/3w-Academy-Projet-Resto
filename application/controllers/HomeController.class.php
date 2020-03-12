<?php

class HomeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		$mealModel = new MealModel();
		$meals = $mealModel->getAllMeal();
		
	   
		return [
             'meals' => $meals,
             'flashBag' => new FlashBag() 
            ];
		
	}
	

    public function httpPostMethod(Http $http, array $formFields)
    {
    	
    }
}