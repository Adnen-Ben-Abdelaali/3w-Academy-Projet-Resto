<?php

class BookingController
{
    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession();
        if($userSession->isAuthenticated()==false)
        {
            $http->redirectTo('/user/login');
        }
    }
    public function  httpPostMethod(Http $http, array $formFields)
    {
        $userSession = new UserSession();
        if($userSession->isAuthenticated() == false)
        {
            $http->redirectTo('/user/login');
        }
       

        $bookingModel = new BookingModel();
        $bookingModel->creat(
         
        $formFields['BookingDay'].'-'.$formFields['BookingMonth'].'-'.$formFields['BookingYear'],
            $formFields['BookingTime'],
            $formFields['NumberOfSeats'], 
            $userSession->getUserId() 

        );
        $http->redirectTo('/');
         
       
    }
}