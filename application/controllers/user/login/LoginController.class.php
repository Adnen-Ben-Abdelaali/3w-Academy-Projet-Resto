<?php

  class LoginController
  {

    public function httpGetMethod(Http $http, array $queryFields)
    {

      /*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

       return ["_form" => new LoginForm()];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contiil y a dejaent l'équivalent de $_POST en PHP natif.
		 */

      try 
      {
        $userModel = new UserModel();
            $user      = $userModel->findWithEmailPassword
            (
                $formFields['email'],
                $formFields['password']
            );            // Construction de la session utilisateur.
            $userSession = new UserSession();
            $userSession->create
            (
                $user['Id'],
                $user['FirstName'],
                $user['LastName'],
                $user['Email'],
                $user['Admin']
            );
        //$userSession = new UserSession();
        //$userSession->create();
        /*
        print_r($user);
        die();
        */
        
        $http->redirectTo('/');
      }
      catch (DomainException $e)
      {
        $loginForm = new LoginForm();
        $loginForm->bind($formFields);
        $loginForm->setErrorMessage($e->getMessage());

        return ['_form' =>  $loginForm];
      
      }

    }

  }