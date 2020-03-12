<?php
class LoginController

{
    public function httpGetMethod(Http $http, array $queryFields)
    
    {  
            return 
            [ 
                '_form' => new LoginForm()
            ];

    }

    public function httpPostMethod(Http $http, array $formFields)
    
    {
        try
        { 
            $userModel= new UserModel();
            $user = $userModel->findWithEmailPassword($formFields['email'],$formFields['password']);
           



            $userSession = new UserSession();

            $userSession->create(

            $user['Id'],
            $user['FirstName'],
            $user['LastName'],
            $user['Email'],
            $user['Admin']
            
            );



             
            $http->redirectTo('/');
        }

        catch (DomainException $e) 
        {
            $loginform= new LoginForm();
            $loginform->bind($formFields);
            $loginform->setErrorMessage( $e->getMessage());

            
            return
            [
                '_form' => $loginform
            ];
        }

    }

}

?>