<?php

class UserController
{
    public function httpGetMethod(Http $http, array $queryFields)

    {   
        return 
        [ 
            '_form' => new UserForm()
        ] ;
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        try
        { 
           $userModel= new UserModel();
           $user = $userModel->signUp(
           $formFields['lastName'],
           $formFields['firstName'],
           $formFields['email'],
           $formFields['password'],
           $formFields['birdhYear'].'-'. $formFields['birthMonth'].'-'.$formFields['birthDay'],
           $formFields['address'],
           $formFields['city'],
           $formFields['country'],
           $formFields['zipCode'],
           $formFields['phone']
           );

           $http->redirectTo('/');
           

        }
        catch (DomainException $e) 
        {
            //echo $e->getMessage();
            //return [ 'errorMessage' => $e->getMessage() ];

            $userForm= new UserForm();
            $userForm->bind($formFields);
            $userForm->setErrorMessage($e->getMessage());

            return
            [
                '_form' => $userForm
            ];
        }

    }
   
}