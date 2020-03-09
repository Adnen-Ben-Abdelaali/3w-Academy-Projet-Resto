<?php

class UserModel
{

    public function signUp($lastName,
                            $firstName,
                            $email,
                            $password,
                            $birthDate,
                            $address,
                            $city,
                            $country,
                            $zipCode,
                            $phone)
     {
        $baseUser = new Database();
        $user = $baseUser->queryOne('SELECT * FROM user WHERE email =?',[$email]);
        if(!empty($user))
        {
            throw new DomainException('un mail existant');

        }

        $sql ="INSERT INTO user (LastName, FirstName, Email, Password, Address, Birthdate, City,
         Country, ZipCode, Phone, CreationTimestamp)
        VALUES(?,?,?,?,?,?,?,?,?,?,NOW())";
        
        $hashed_password = password_hash($password,PASSWORD_BCRYPT);
           
        $baseUser->executeSql($sql,
        [$lastName,
        $firstName,
        $email,
        $hashed_password,
        $address,
        $birthDate,
        $city,
        $country,
        $zipCode,
        $phone]
    );

        $flashBag = new FlashBag();
        $flashBag->add("votre compte a été crée avec succès");
       
        

    }


    public function find($userId)
    {
      //retourne l'utilisateur dont l'Id est passé en paramètre
      
      $database = new Database();
  
      $sql = 'SELECT * FROM user where Id = ?';
  
      return $database->queryOne($sql,[$userId]);
      
      
    }
  
    public function findWithEmailPassword($email, $password)
    {
      //vérifie, lève une exception ou retourne un utilisateur 
      
      $database = new Database();
  
      $sql = 'SELECT * FROM user where Email = ?';
      
      $user = $database->queryOne($sql,[$email]);

      if(empty($user))
      {
          throw new DomainException("Adresse mail inexistante!");
      }

      if(password_verify($password,$user['Password']) == false)
      {
        throw new DomainException("Mot de passe incorrect!");
      }

      return $user;

    }
  
    public function updateLoginTimestamp($userId)
    {
      //met à jour la date de la dernière connexion d'un utilisateur
    }
  
 
	

}