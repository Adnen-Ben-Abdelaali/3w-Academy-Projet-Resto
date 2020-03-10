<?php

  class LoginModel extends UserModel
  {
    
    private $userExists;

    public function find($userId)
  {
    //retourne l'utilisateur dont l'Id est passé en paramètre
    
    $database = new Database();

    $sql = 'SELECT Email FROM user where Email = ?';

    $this->userExists->$database->queryOne($sql, $userId);
      
  }

  public function findWithEmailPassword($email, $password)
    {
        $database = new Database();        // Récupération de l'utilisateur ayant l'email spécifié en argument.
        $user = $database->queryOne
        (
            "SELECT
                Id,
                LastName,
                FirstName,
                Email,
                Password,
                Admin
            FROM User
            WHERE Email = ?",
            [ $email ]
        );        // Est-ce qu'on a bien trouvé un utilisateur ?
        if(empty($user) == true)
        {
            throw new DomainException
            (
                "Il n'y a pas de compte utilisateur associé à cette adresse email"
            );
        }        // Est-ce que le mot de passe spécifié est correct par rapport à celui stocké ?
    	if($this->verifyPassword($password, $user['Password']) == false)
    	{
			throw new DomainException
			(
				'Le mot de passe spécifié est incorrect'
			);
    	}		return $user;
    }


  private function verifyPassword($password, $hashedPassword)
	{
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
		return crypt($password, $hashedPassword) == $hashedPassword;
	}



}