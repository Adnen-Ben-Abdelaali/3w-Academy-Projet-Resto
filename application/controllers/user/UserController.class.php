<?php


    class UserController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
			return ["_form" => new UserForm()];

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
			$userModel->signUp
			(
			$formFields['lastName'],
			$formFields['firstName'],
			$formFields['email'],
			$formFields['password'],
			$formFields['birthYear'].'-'.$formFields['birthMonth'].'-'.$formFields['birthDay'],
			$formFields['address'],
			$formFields['city'],
			$formFields['country'],
			$formFields['zipCode'],
			$formFields['phone']);

			$http->redirectTo('/');
		}
	catch(DomainException $e)
	{
		
		$userForm = new UserForm();
		$userForm->bind($formFields);
		$userForm->setErrorMessage($e->getMessage());

		return ["_form" => $userForm];

	}
		 
    }
}


