<?php

  class LoginModel extends UserModel
  {
    
    private $userExists;

    public function find($userId)
  {
    //retourne l'utilisateur dont l'Id est passé en paramètre
    
    $database = new Database();

    $sql = 'SELECT Email FROM user where Email = ?';

    $userExists->$database->queryOne($sql, $userId);
      
  }

  public function findWithEmailPassword($email, $password)
  {
    //vérifie, lève une exception ou retourne un utilisateur 
    
    if(!empty($userExists)) 
    {

      $sql = "SELECT Email, Password FROM user WHERE Email = ? AND Password = ?";
    }

  }

  public function updateLoginTimestamp($userId)
  {
    //met à jour la date de la dernière connexion d'un utilisateur
  }

  }