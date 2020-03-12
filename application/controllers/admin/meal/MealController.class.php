<?php

class MealController

{

    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession();
        if($userSession->isAuthenticated()==false)
        {
            $http->redirectTo('/user/login');
        }
        $mealModel = new MealModel();
        $meals = $mealModel->getAllMeal();
        return 

        [
             'meals' => $meals
        ];


    }


    
    
    public function  httpPostMethod(Http $http, array $formFields)

    {
        $userSession = new UserSession();

        if($userSession->isAuthenticated()==false)
        {
            $http->redirectTo('/user/login');
        }


            $photo=$http-> moveUploadedFile('Photo',"/images/meals" );

       if ( $photo == false)
        {
            $photo = "no_Photo.png";
            
        }

      if(empty( $formFields['Name'] == false))
      {
        
            $mealModel = new MealModel();
            
            $mealModel->creatMeal(

                $formFields['Name'],
                $photo,
                $formFields['Description'],
                $formFields['QuantityInStock'],
                $formFields['BuyPrice'],
                $formFields['SalePrice']

        );
        $http->redirectTo('/');
          
          
      }

      array_push($meals, $formFields['Name']);
    
        
    }

}